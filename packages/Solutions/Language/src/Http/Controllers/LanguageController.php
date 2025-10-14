<?php
namespace Solutions\Language\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Solutions\Language\Models\Language;

class LanguageController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int)($request->get('per_page', 12));
        $items = Language::orderBy('order')->paginate($perPage);
        return view('language::index', compact('items'));
    }

    public function create()
    {
        return view('language::create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'code' => 'required|string|max:10|unique:languages,code',
            'dir'  => 'required|in:ltr,rtl',
            'locale' => 'nullable|string|max:20',
            'order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
            'is_default' => 'nullable|boolean',
        ]);

        $data['status'] = (int) ($data['status'] ?? 1);
        $data['is_default'] = (int) ($data['is_default'] ?? 0);
        $data['order'] = $data['order'] ?? (int) (Language::max('order') + 1);

        DB::transaction(function() use ($data){
            if(!empty($data['is_default'])){
                Language::query()->update(['is_default' => false]);
            }
            Language::create($data);
        });

        return redirect()->route('language.index')->with('success', __('language::messages.created_success'));
    }

    public function edit(Language $language)
    {
        return view('language::edit', compact('language'));
    }

    public function update(Request $request, Language $language)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'code' => 'required|string|max:10|unique:languages,code,' . $language->id,
            'dir'  => 'required|in:ltr,rtl',
            'locale' => 'nullable|string|max:20',
            'order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
            'is_default' => 'nullable|boolean',
        ]);

        $data['status'] = (int) ($data['status'] ?? 1);
        $data['is_default'] = (int) ($data['is_default'] ?? 0);
        $data['order'] = $data['order'] ?? $language->order;

        DB::transaction(function() use ($language, $data){
            if(!empty($data['is_default'])){
                Language::query()->where('id', '<>', $language->id)->update(['is_default' => false]);
            }
            $language->update($data);
        });

        return redirect()->route('language.index')->with('success', __('language::messages.updated_success'));
    }

    public function destroy(Language $language)
    {
        if($language->is_default){
            return back()->with('error', __('language::messages.cannot_delete_default'));
        }
        $language->delete();
        return back()->with('success', __('language::messages.deleted_success'));
    }

    public function toggleStatus(Language $language)
    {
        $language->status = !$language->status;
        $language->save();
        return back()->with('success', __('language::messages.status_updated_success'));
    }

    public function setDefault(Language $language)
    {
        DB::transaction(function() use ($language){
            Language::query()->update(['is_default' => false]);
            $language->is_default = true;
            $language->status = true;
            $language->save();
        });
        return back()->with('success', __('language::messages.default_set_success'));
    }

    public function updateOrder(Request $request)
    {
        $rows = $request->input('orders', []);

        if (is_array($rows) && isset($rows[0]['id'])) {
            $tmp = [];
            foreach ($rows as $row) {
                if (!isset($row['id'])) continue;
                $tmp[$row['id']] = (int)($row['order'] ?? 0);
            }
            $rows = $tmp;
        }

        if (!$rows || !is_array($rows)) {
            return response()->json([
                'ok' => false,
                'message' => __('language::messages.no_valid_rows')
            ], 422);
        }

        foreach ($rows as $id => $ord) {
            Language::whereKey($id)->update(['order' => (int)$ord]);
        }

        return response()->json([
            'ok' => true,
            'message' => __('language::messages.order_saved_success')
        ]);
    }

    public function switchAdmin($code)
    {
        $lang = Language::where('status',1)->where('code',$code)->first();
        abort_if(!$lang, 404);

        session(['admin_locale' => $lang->code]);
        app()->setLocale($lang->code);

        return back(); 
    }
}
