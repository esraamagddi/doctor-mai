<?php
namespace Solutions\Faqs\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Solutions\Faqs\Models\FaqCategory;

class FaqCategoryController extends Controller
{

    /** جلب اللغات المفعلة + تحديد التاب النشط */
    private function resolveLocales(\Illuminate\Http\Request $request): array
    {
        try {
            $langs = \Solutions\Language\Models\Language::query()
                ->where('status', 1)->orderBy('order')->get(['name','code']);
        } catch (\Throwable $e) {
            $langs = collect([
                (object)['name' => 'English', 'code' => 'en'],
                (object)['name' => 'العربية',  'code' => 'ar'],
            ]);
        }
        $activeLocale = $request->get('lang', $langs->first()->code ?? 'en');
        return [$langs, $activeLocale];
    }


    public function index(Request $request)
    {
        $perPage = (int) $request->get('per_page', 12);
        $items = FaqCategory::orderBy('order')->orderByDesc('id')->paginate($perPage);
        return view('faqs::categories.index', compact('items'));
    }

    public function create(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        $category = new FaqCategory();
        return view('faqs::categories.create', compact('category','langs','activeLocale'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|array',
            'slug'  => 'required|string|max:190|unique:faq_categories,slug',
            'order' => 'nullable|integer|min:0',
            'status'=> 'nullable|boolean',
        ]);
        $data['status'] = (bool) ($data['status'] ?? 0);
        FaqCategory::create($data);
        return redirect()->route('faqs.categories.index')->with('success', 'Created');
    }

    public function edit(Request $request, FaqCategory $category)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        return view('faqs::categories.edit', compact('category','langs','activeLocale'));
    }

    public function update(Request $request, FaqCategory $category)
    {
        $data = $request->validate([
            'title' => 'nullable|array',
            'slug'  => 'required|string|max:190|unique:faq_categories,slug,'.$category->id,
            'order' => 'nullable|integer|min:0',
            'status'=> 'nullable|boolean',
        ]);
        $data['status'] = (bool) ($data['status'] ?? 0);
        $category->update($data);
        return redirect()->route('faqs.categories.index')->with('success', 'Updated');
    }

    public function destroy(FaqCategory $category)
    {
        $category->delete();
        return back()->with('success', 'Deleted');
    }

    public function toggleStatus(FaqCategory $category)
    {
        $category->status = !$category->status;
        $category->save();
        return back()->with('success', 'Toggled');
    }

    public function updateOrder(Request $request)
    {
        $payload = $request->input('orders', $request->input('order', []));
        $rows = [];
        if (array_is_list($payload)) {
            foreach ($payload as $row) {
                if (!isset($row['id'])) continue;
                $rows[$row['id']] = (int)($row['order'] ?? 0);
            }
        } else {
            foreach ($payload as $id => $order) {
                $rows[$id] = (int)$order;
            }
        }
        if (!$rows) return response()->json(['ok'=>false,'message'=>'No valid rows'], 422);
        foreach ($rows as $id => $ord) {
            FaqCategory::whereKey($id)->update(['order'=>$ord]);
        }
        return response()->json(['ok'=>true]);
    }
}
