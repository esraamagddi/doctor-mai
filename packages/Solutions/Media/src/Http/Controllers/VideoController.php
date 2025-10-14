<?php

namespace Solutions\Media\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Solutions\Media\Models\Video;
use Solutions\Media\Models\VideoCategory;

class VideoController extends Controller
{
    private function resolveLocales(Request $request): array
    {
        try {
            $langs = \Solutions\Language\Models\Language::query()
                ->where('status', 1)
                ->orderBy('order')
                ->get(['code', 'name', 'dir', 'is_default']);
        } catch (\Throwable $e) {
            $langs = collect([
                (object) [
                    'code' => 'en',
                    'name' => 'English',
                    'dir'  => 'ltr',
                    'is_default' => app()->getLocale() === 'en'
                ]
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

    public function index(Request $request)
    {
        $perPage = (int) $request->get('per_page', 12);
        $items = Video::with('category')
            ->orderBy('order')
            ->orderByDesc('id')
            ->paginate($perPage);

        return view('media::videos.index', compact('items'));
    }

    public function create(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        $categories = VideoCategory::where('status', 1)->orderBy('order')->get();

        return view('media::videos.create', compact('langs', 'activeLocale', 'categories'));
    }

    public function store(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        $default = optional($langs->firstWhere('is_default', 1))->code ?: app()->getLocale() ?: 'en';

        $rules = [
            'title'                 => 'required|array',
            'title.' . $default     => 'required|string',
            'title.*'               => 'nullable|string',
            'description'           => 'nullable|array',
            'description.*'         => 'nullable|string',
            'embed_code'            => 'required',
            'image'                 => 'nullable|image|max:10240',
            'order'                 => 'nullable|integer|min:0',
            'status'                => 'nullable|boolean',
            'category_id'           => 'required|exists:video_categories,id',
            'video_file'            => 'nullable|file', // إن وُجد
        ];

        $data = $request->validate($rules);

        // حفظ الغلاف
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('media/videos/covers', 'public');
        }

        // حفظ الفيديو (اختياري)
        if ($request->hasFile('video_file')) {
            $data['video_url'] = $request->file('video_file')->store('media/videos/files', 'public');
        } else {
            // في وضع embed فقط
            $data['video_url'] = '#';
        }

        $data['status'] = array_key_exists('status', $data) ? (int) !!$data['status'] : 1;
        $data['order']  = $data['order'] ?? (int) (Video::max('order') + 1);

        Video::create($data);

        return redirect()->route('media.videos.index')->with('ok', 'Created');
    }

    public function edit(Request $request, Video $video)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);

        if (old()) {
            foreach (array_keys((array) old('title', [])) as $k) {
                if ($k && $langs->contains('code', $k)) {
                    $activeLocale = $k;
                    break;
                }
            }
        }

        // >>> مهم: تمرير التصنيفات للواجهة
        $categories = VideoCategory::where('status', 1)->orderBy('order')->get();

        return view('media::videos.edit', compact('video', 'langs', 'activeLocale', 'categories'));
    }

    public function update(Request $request, Video $video)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        $default = optional($langs->firstWhere('is_default', 1))->code ?: app()->getLocale() ?: 'en';

        $rules = [
            'title'                 => 'required|array',
            'title.' . $default     => 'required|string',
            'title.*'               => 'nullable|string',
            'description'           => 'nullable|array',
            'description.*'         => 'nullable|string',
            'embed_code'            => 'required',
            'image'                 => 'nullable|image|max:10240',
            'order'                 => 'nullable|integer|min:0',
            'status'                => 'nullable|boolean',
            'category_id'           => 'required|exists:video_categories,id',
            'video_file'            => 'nullable|file', // إن وُجد
        ];

        $data = $request->validate($rules);

        // تحديث الغلاف إذا تم رفعه
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('media/videos/covers', 'public');
        } else {
            // لا تغيّر قيمة image الحالية إذا لم يُرفع جديد
            unset($data['image']);
        }

        // تحديث ملف الفيديو إذا تم رفعه
        if ($request->hasFile('video_file')) {
            $data['video_url'] = $request->file('video_file')->store('media/videos/files', 'public');
        } else {
            // لا تغيّر قيمة video_url الحالية إذا لم يُرفع جديد
            unset($data['video_file'], $data['video_url']);
        }

        $data['status'] = array_key_exists('status', $data) ? (int) !!$data['status'] : $video->status;

        $video->update($data);

        return redirect()->route('media.videos.index')->with('ok', 'Updated');
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('media.videos.index')->with('ok', 'Deleted');
    }

    public function toggleStatus(Video $video)
    {
        $video->status = $video->status ? 0 : 1;
        $video->save();

        return request()->wantsJson()
            ? response()->json(['status' => $video->status])
            : back()->with('ok', 'Toggled');
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
                if (!isset($row['id'])) continue;
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
            Video::whereKey($id)->update(['order' => $ord]);
        }

        return response()->json(['ok' => true]);
    }
}
