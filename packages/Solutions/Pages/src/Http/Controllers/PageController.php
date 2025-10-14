<?php

namespace Solutions\Pages\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Solutions\Pages\Models\Page;

class PageController extends Controller
{
    private function resolveLocales(Request $request): array
    {
        try {
            $langs = \Solutions\Language\Models\Language::query()
                ->where('status', 1)->orderBy('order')
                ->get(['code', 'name', 'dir', 'is_default']);
        } catch (\Throwable $e) {
            $langs = collect([
                (object) ['code' => 'en', 'name' => 'English', 'dir' => 'ltr', 'is_default' => 1],
                (object) ['code' => 'ar', 'name' => 'Arabic', 'dir' => 'rtl', 'is_default' => 0],
            ]);
        }

        $active = (string) $request->get('lang', '');
        if (!$active)
            $active = optional($langs->firstWhere('is_default', 1))->code ?: app()->getLocale();
        if (!$langs->contains('code', $active))
            $active = optional($langs->first())->code ?: 'en';

        return [$langs, $active];
    }

    public function index(Request $request)
    {
        $perPage = (int) $request->get('per_page', 12);
        $items = Page::orderBy('order')->orderByDesc('id')->paginate($perPage);

        return view('pages::index', compact('items'));
    }

    public function create(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        return view('pages::create', compact('langs', 'activeLocale'));
    }

    public function store(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        $default = optional($langs->firstWhere('is_default', 1))->code ?: app()->getLocale() ?: 'en';

        $rules = [
            'title'             => 'required|array',
            'title.' . $default => 'required|string',
            'title.*'           => 'nullable|string',

            'description'       => 'nullable|array',
            'description.*'     => 'nullable|string',
            'image'             => 'nullable|image|max:10240',
            'slug'              => 'required|string|max:191|alpha_dash|unique:pages,slug',
            'order'             => 'nullable|integer|min:0',
            'status'            => 'nullable|boolean',
        ];
        $data = $request->validate($rules);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('pages/images', 'public');
        }

        $data['status'] = array_key_exists('status', $data) ? (int) !!$data['status'] : 1;
        $data['order']  = $data['order'] ?? (int) (Page::max('order') + 1);

        Page::create($data);

        return redirect()->route('pages.index')->with('ok', 'Created');
    }

    public function edit(Request $request, Page $page)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        if (old()) {
            foreach (array_keys((array) old('description', [])) as $k) {
                if ($k && $langs->contains('code', $k)) {
                    $activeLocale = $k;
                    break;
                }
            }
        }
        return view('pages::edit', compact('page', 'langs', 'activeLocale'));
    }

    public function update(Request $request, Page $page)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        $default = optional($langs->firstWhere('is_default', 1))->code ?: app()->getLocale() ?: 'en';

        $rules = [
            'title'             => 'required|array',
            'title.' . $default => 'required|string',
            'title.*'           => 'nullable|string',

            'description'       => 'nullable|array',
            'description.*'     => 'nullable|string',
            'image'             => 'nullable|image|max:10240',
            'slug'              => 'required|string|max:191|alpha_dash|unique:pages,slug,' . $page->id,
            'order'             => 'nullable|integer|min:0',
            'status'            => 'nullable|boolean',
        ];
        $data = $request->validate($rules);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('pages/images', 'public');
        } else {
            unset($data['image']);
        }

        $data['status'] = array_key_exists('status', $data) ? (int) !!$data['status'] : $page->status;

        $page->update($data);

        return redirect()->route('pages.index')->with('ok', 'Updated');
    }


    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('pages.index')->with('ok', 'Deleted');
    }

    public function toggleStatus(Page $page)
    {
        $page->status = $page->status ? 0 : 1;
        $page->save();
        return request()->wantsJson() ? response()->json(['status' => $page->status]) : back()->with('ok', 'Toggled');
    }

    public function updateOrder(Request $request)
    {
        $payload = $request->input('rows', $request->input('orders', $request->input('order', [])));
        if (!is_array($payload) || empty($payload))
            return response()->json(['ok' => false, 'message' => 'No payload'], 422);

        $isList = array_keys($payload) === range(0, count($payload) - 1);
        $rows = [];

        if ($isList) {
            foreach ($payload as $row) {
                if (!isset($row['id'])) continue;
                $rows[(int) $row['id']] = (int) ($row['order'] ?? 0);
            }
        } else {
            foreach ($payload as $id => $order) {
                $rows[(int) $id] = (int) $order;
            }
        }

        if (!$rows)
            return response()->json(['ok' => false, 'message' => 'No valid rows'], 422);

        foreach ($rows as $id => $ord)
            Page::whereKey($id)->update(['order' => $ord]);

        return response()->json(['ok' => true]);
    }
}
