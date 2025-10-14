<?php
namespace Solutions\Faqs\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Solutions\Faqs\Models\Faq;
use Solutions\Faqs\Models\FaqCategory;

class FaqController extends Controller
{
    private function resolveLocales(Request $request): array
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
        $items = Faq::orderBy('order')->orderByDesc('id')->paginate($perPage);
        $categories = FaqCategory::orderBy('order')->get();
        return view('faqs::faqs.index', compact('items','categories'));
    }

    public function create(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        $faq = new Faq();
        $categories = FaqCategory::orderBy('order')->get();

        return view('faqs::faqs.create', compact('faq','langs','activeLocale','categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'question' => 'nullable|array',
            'answer'   => 'nullable|array',
            'category_id' => 'nullable|exists:faq_categories,id',
            'order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);
        $data['status'] = (bool) ($data['status'] ?? 0);
        Faq::create($data);
        return redirect()->route('faqs.index')->with('success', 'Created');
    }

    public function edit(Request $request, Faq $faq)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        $categories = FaqCategory::orderBy('order')->get();

        return view('faqs::faqs.edit', compact('faq','langs','activeLocale','categories'));
    }

    public function update(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'question' => 'nullable|array',
            'answer'   => 'nullable|array',
            'category_id' => 'nullable|exists:faq_categories,id',
            'order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);
        $data['status'] = (bool) ($data['status'] ?? 0);
        $faq->update($data);
        return redirect()->route('faqs.index')->with('success', 'Updated');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return back()->with('success', 'Deleted');
    }

    public function toggleStatus(Faq $faq)
    {
        $faq->status = !$faq->status;
        $faq->save();
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
            Faq::whereKey($id)->update(['order'=>$ord]);
        }
        return response()->json(['ok'=>true]);
    }
}
