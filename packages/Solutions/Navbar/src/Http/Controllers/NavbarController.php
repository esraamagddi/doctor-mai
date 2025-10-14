<?php
namespace Solutions\Navbar\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Solutions\Navbar\Models\Navbar;
class NavbarController extends Controller
{
    private function resolveLocales(Request $request): array
    {
        try {
            $langs = \Solutions\Language\Models\Language::query()
                ->where('status', 1)->orderBy('order')
                ->get(['code', 'name', 'dir', 'is_default']);
        } catch (\Throwable $e) {
            $langs = collect();
        }
        if ($langs->isEmpty()) {
            $langs = collect([
                (object) ['code' => 'en', 'name' => 'English', 'dir' => 'ltr', 'is_default' => app()->getLocale() === 'en'],
            ]);
        }
        $active = (string) $request->get('lang', '');
        if (!$active) {
            $active = optional($langs->firstWhere('is_default', 1))->code ?: app()->getLocale();
        }
        if (!$langs->contains('code', $active)) {
            $active = optional($langs->first())->code ?: 'en';
        }
        return [$langs, $active];
    }

    private function normalizeSlug(?string $slug): string
    {
        $slug = trim((string) $slug);
        $slug = preg_replace('/\s+/u', '-', $slug);
        $slug = preg_replace('/[^A-Za-z0-9\.\_\-\/:]+/u', '', $slug);
        return strtolower($slug);
    }

    public function index(Request $request)
    {
        $perPage = (int) ($request->get('per_page', 12));
        $items = Navbar::orderBy('order')
            ->orderByDesc('id')
            ->paginate($perPage);
        return view('navbar::index', compact('items'));
    }

    public function children(Navbar $header)
    {
        $items = Navbar::orderBy('order')
            ->orderByDesc('id')
            ->paginate(12);

        return view('navbar::children', compact('header', 'items'));
    }

    public function create(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        $parents = Navbar::orderBy('order')->get(); // القايمة الرئيسية
        return view('navbar::create', compact('langs', 'activeLocale', 'parents'));
    }

    public function store(Request $request)
    {
        [$langs] = $this->resolveLocales($request);
        $default = optional($langs->firstWhere('is_default', 1))->code ?: app()->getLocale() ?: 'en';

        $request->merge(['slug' => $this->normalizeSlug($request->input('slug'))]);

        $rules = [
            'slug' => 'required|string|max:255|regex:/^[A-Za-z0-9\.\_\-\/:]+$/|unique:navbar,slug',
            'title' => 'required|array',
            'title.' . $default => 'required|string',
            'title.*' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:4096',
            'order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ];

        $data = $request->validate($rules);

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('ui/headers', 'public');
        }

        $data['status'] = array_key_exists('status', $data) ? (int) !!$data['status'] : 1;
        $data['order'] = $data['order'] ?? (int) (Navbar::max('order') + 1);

        Navbar::create($data);
        return redirect()->route('navbar.index')->with('ok', 'Created');
    }

    public function edit(Request $request, Navbar $header)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        $parents = Navbar::where('id', '!=', $header->id)->orderBy('order')->get();

        if (old()) {
            foreach (array_keys((array) old('title', [])) as $k) {
                if ($k && $langs->contains('code', $k)) {
                    $activeLocale = $k;
                    break;
                }
            }
        }

        return view('navbar::edit', compact('header', 'langs', 'activeLocale', 'parents'));
    }

    public function update(Request $request, Navbar $header)
    {
        [$langs] = $this->resolveLocales($request);
        $default = optional($langs->firstWhere('is_default', 1))->code ?: app()->getLocale() ?: 'en';

        $request->merge(['slug' => $this->normalizeSlug($request->input('slug'))]);

        $rules = [
            'slug' => 'required|string|max:255|regex:/^[A-Za-z0-9\.\_\-\/:]+$/|unique:navbar,slug,' . $header->id,
            'title' => 'required|array',
            'title.' . $default => 'required|string',
            'title.*' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:4096',
            'order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ];

        $data = $request->validate($rules);

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('ui/headers', 'public');
        } else {
            unset($data['icon']);
        }

        $data['status'] = array_key_exists('status', $data) ? (int) !!$data['status'] : $header->status;

        $header->update($data);
        return redirect()->route('navbar.index')->with('ok', 'Updated');
    }

    public function destroy(Navbar $header)
    {
        $header->delete();
        return redirect()->route('navbar.index')->with('ok', 'Deleted');
    }

    public function toggleStatus(Navbar $header)
    {
        $header->status = $header->status ? 0 : 1;
        $header->save();
        if (request()->wantsJson()) {
            return response()->json(['status' => $header->status]);
        }
        return back()->with('ok', 'Toggled');
    }

    public function updateOrder(Request $request)
    {
        $payload = $request->input('rows', $request->input('orders', $request->input('order', [])));
        if (!is_array($payload) || empty($payload)) {
            return response()->json(['ok' => false, 'message' => 'No payload'], 422);
        }
        $isList = array_keys($payload) === range(0, count($payload) - 1);
        $rows = [];
        if ($isList) {
            foreach ($payload as $row) {
                if (!isset($row['id']))
                    continue;
                $rows[(int) $row['id']] = (int) ($row['order'] ?? 0);
            }
        } else {
            foreach ($payload as $id => $order) {
                $rows[(int) $id] = (int) $order;
            }
        }
        if (!$rows) {
            return response()->json(['ok' => false, 'message' => 'No valid rows'], 422);
        }
        foreach ($rows as $id => $ord) {
            Navbar::whereKey($id)->update(['order' => $ord]);
        }
        return response()->json(['ok' => true]);
    }
}
