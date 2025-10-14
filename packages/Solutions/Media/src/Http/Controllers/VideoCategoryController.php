<?php

namespace Solutions\Media\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Solutions\Media\Models\VideoCategory;

class VideoCategoryController extends Controller
{
    private function resolveLocales(Request $request): array
    {
        try {
            $langs = \Solutions\Language\Models\Language::query()
                ->where('status', 1)->orderBy('order')
                ->get(['id','code','name','is_default']);
        } catch (\Throwable $e) {
            $langs = collect([
                (object)['id'=>1,'code'=>'en','name'=>'English','is_default'=>1],
                (object)['id'=>2,'code'=>'ar','name'=>'Arabic','is_default'=>0],
            ]);
        }
        $activeLocale = $request->get('locale')
            ?: optional($langs->firstWhere('is_default', 1))->code
            ?: app()->getLocale()
            ?: 'en';
        return [$langs, $activeLocale];
    }

    public function index(Request $request)
    {
        $perPage = (int) $request->get('per_page', 20);
        $items = VideoCategory::orderBy('order')->orderByDesc('id')->paginate($perPage);
        return view('media::categories.index', compact('items'));
    }

    public function create(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        return view('media::categories.create', compact('langs', 'activeLocale'));
    }

    public function store(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        $default = optional($langs->firstWhere('is_default', 1))->code ?: app()->getLocale() ?: 'en';

        $rules = [
            'name'            => 'required|array',
            'name.'.$default  => 'required|string',
            'name.*'          => 'nullable|string',
            'order'           => 'nullable|integer|min:0',
            'status'          => 'nullable|boolean',
        ];

        $data = $request->validate($rules);
        $data['status'] = array_key_exists('status', $data) ? (int) !!$data['status'] : 1;
        $data['order']  = $data['order'] ?? (int) (VideoCategory::max('order') + 1);

        VideoCategory::create($data);

        return redirect()->route('media.video_categories.index')->with('ok', 'Created');
    }

    public function edit(Request $request, VideoCategory $video_category)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        if (old()) {
            $video_category->fill([
                'name'   => $request->old('name', $video_category->name),
                'order'  => $request->old('order', $video_category->order),
                'status' => (int) !!$request->old('status', $video_category->status),
            ]);
        }
        return view('media::categories.edit', ['item' => $video_category, 'langs' => $langs, 'activeLocale' => $activeLocale]);
    }

    public function update(Request $request, VideoCategory $video_category)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        $default = optional($langs->firstWhere('is_default', 1))->code ?: app()->getLocale() ?: 'en';

        $rules = [
            'name'            => 'required|array',
            'name.'.$default  => 'required|string',
            'name.*'          => 'nullable|string',
            'order'           => 'nullable|integer|min:0',
            'status'          => 'nullable|boolean',
        ];

        $data = $request->validate($rules);
        $data['status'] = array_key_exists('status', $data) ? (int) !!$data['status'] : 1;
        $video_category->update($data);

        return redirect()->route('media.video_categories.index')->with('ok', 'Updated');
    }

    public function destroy(VideoCategory $video_category)
    {
        $video_category->delete();
        return redirect()->route('media.video_categories.index')->with('ok', 'Deleted');
    }

    public function toggleStatus(VideoCategory $video_category)
    {
        $video_category->status = !$video_category->status;
        $video_category->save();
        return back()->with('ok', 'Toggled');
    }

    public function updateOrder(Request $request)
    {
        $rows = [];
        if (is_array($payload = $request->get('rows'))) {
            foreach ($payload as $id => $order) {
                $rows[(int) $id] = (int) $order;
            }
        }
        if (!$rows) {
            return response()->json(['ok' => false, 'message' => 'No valid rows'], 422);
        }

        foreach ($rows as $id => $ord) {
            VideoCategory::whereKey($id)->update(['order' => $ord]);
        }
        return response()->json(['ok' => true]);
    }
}
