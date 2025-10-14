<?php
namespace Solutions\Blog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Solutions\Blog\Models\Category;

class CategoryController extends Controller
{
    /** جلب اللغات المفعلة + تحديد التاب النشط */
    private function resolveLocales(Request $request): array
    {
        try {
            $langs = \Solutions\Language\Models\Language::query()
                ->where('status', 1)
                ->orderBy('order')
                ->get(['code', 'name', 'dir', 'is_default']);
        } catch (\Throwable $e) {
            $langs = collect([(object) ['code' => 'en', 'name' => 'English', 'dir' => 'ltr', 'is_default' => true]]);
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

    public function index(Request $request)
    {
        $perPage = (int) ($request->get('per_page', 20));
        $items = Category::with('parent')->orderBy('order')->orderBy('name->en')->paginate($perPage);
        return view('blog::categories.index', compact('items'));
    }

    public function create(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        $parents = Category::orderBy('order')->get();
        return view('blog::categories.create', compact('langs', 'activeLocale', 'parents'));
    }

    public function store(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);

        $rules = [
            'parent_id' => 'nullable|exists:categories,id',
            'order' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ];

        foreach ($langs as $L) {
            $rules['name.' . $L->code] = 'required|string';
            $rules['description.' . $L->code] = 'nullable|string';
        }

        $data = $request->validate($rules);
        $data['status'] = $data['status'] ?? 1;
        Category::create($data);

        return redirect()->route('blog.categories.index')->with('success', __('blog::messages.created_successfully'));
    }

    public function edit(Request $request, Category $category)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        $parents = Category::where('id', '!=', $category->id)->orderBy('order')->get();

        if (old()) {
            foreach (array_keys((array) old('name', [])) as $k) {
                if ($k && $langs->contains('code', $k)) {
                    $activeLocale = $k;
                    break;
                }
            }
        }

        return view('blog::categories.edit', compact('category', 'langs', 'activeLocale', 'parents'));
    }

    public function update(Request $request, Category $category)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);

        $rules = [
            'parent_id' => 'nullable|exists:categories,id',
            'order' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ];

        foreach ($langs as $L) {
            $rules['name.' . $L->code] = 'required|string';
            $rules['description.' . $L->code] = 'nullable|string';
        }

        $data = $request->validate($rules);
        $category->update($data);

        return redirect()->route('blog.categories.index')->with('success', __('blog::messages.updated_successfully'));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', __('blog::messages.deleted_successfully'));
    }

    public function toggleStatus(Category $category)
    {
        $category->status = !$category->status;
        $category->save();
        return back()->with('success', __('blog::messages.status_toggled'));
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

        foreach ($rows as $id => $ord) {
            Category::whereKey($id)->update(['order' => $ord]);
        }

        return response()->json(['ok' => true]);
    }
}
