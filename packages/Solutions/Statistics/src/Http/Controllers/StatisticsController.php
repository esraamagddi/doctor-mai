<?php
namespace Solutions\Statistics\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Solutions\Statistics\Models\Statistics;
use Solutions\Statistics\Models\StatisticsDetail;
use Solutions\Language\Models\Language;

class StatisticsController extends Controller
{
    private function resolveLocales(Request $request): array
    {
        try {
            $langs = Language::query()
                ->where('status', 1)
                ->orderBy('order')
                ->get(['code','name','dir','is_default']);
        } catch (\Throwable $e) {
            $langs = collect();
        }

        if ($langs->isEmpty()) {
            $langs = collect([ (object)['code'=>'en','name'=>'English','dir'=>'ltr','is_default'=>true] ]);
        }

        $active = (string) $request->get('lang', '');
        if (!$active) $active = optional($langs->firstWhere('is_default',1))->code ?: app()->getLocale();
        if (!$langs->contains('code', $active)) $active = optional($langs->first())->code ?: 'en';

        return [$langs, $active];
    }

    public function index(Request $request)
    {
        $perPage = (int)($request->get('per_page', 12));
        $items = Statistics::orderBy('order')->paginate($perPage);
        return view('statistics::index', compact('items'));
    }

    public function create(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        return view('statistics::create', compact('langs', 'activeLocale'));
    }

    public function store(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);

        $rules = [
            'title'             => 'required|array',
            'short_description' => 'nullable|array',
            'description'       => 'nullable|array',
            'image'             => 'nullable|image|max:5120',
            'order'             => 'nullable|integer',
            'status'            => 'nullable|boolean',
            'details'           => 'nullable|array'
        ];

        foreach ($langs as $L) {
            $rules['title.'.$L->code]             = 'required|string';
            $rules['short_description.'.$L->code] = 'nullable|string';
            $rules['description.'.$L->code]       = 'nullable|string';
        }

        $data = $request->validate($rules);
        $data['status'] = $data['status'] ?? 1;
        $data['order']  = $data['order'] ?? ((int) Statistics::max('order') + 1);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('statistics', 'public');
        }

        $statistics = Statistics::create($data);

        if (!empty($data['details'])) {
            foreach ($data['details'] as $detail) {
                $iconPath = null;
                if (!empty($detail['icon']) && $detail['icon'] instanceof \Illuminate\Http\UploadedFile) {
                    $iconPath = $detail['icon']->store('statistics/icons', 'public');
                }
                $statistics->details()->create([
                    'number'             => $detail['number'] ?? 0,
                    'short_description'  => $detail['short_description'] ?? [],
                    'description'        => $detail['description'] ?? [],
                    'icon'               => $iconPath,
                ]);
            }
        }

        return redirect()->route('statistics.index')->with('ok', 'Created');
    }

    public function edit(Request $request, Statistics $statistics)
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

        // تهيئة التفاصيل بحيث الصور القديمة محفوظة لكل detail
        foreach ($statistics->details as $detail) {
            $detail->icon_old = $detail->icon;
        }

        return view('statistics::edit', compact('statistics', 'langs', 'activeLocale'));
    }

    public function update(Request $request, Statistics $statistics)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);

        $rules = [
            'title'             => 'required|array',
            'short_description' => 'nullable|array',
            'description'       => 'nullable|array',
            'image'             => 'nullable|image|max:5120',
            'order'             => 'nullable|integer',
            'status'            => 'nullable|boolean',
            'details'           => 'nullable|array'
        ];

        foreach ($langs as $L) {
            $rules['title.' . $L->code]             = 'required|string';
            $rules['short_description.' . $L->code] = 'nullable|string';
            $rules['description.' . $L->code]       = 'nullable|string';
        }

        $data = $request->validate($rules);

        $data['status'] = $data['status'] ?? 1;
        $data['order']  = $data['order'] ?? $statistics->order;

        if ($request->hasFile('image')) {
            if ($statistics->image) Storage::disk('public')->delete($statistics->image);
            $data['image'] = $request->file('image')->store('statistics', 'public');
        } else {
            $data['image'] = $statistics->image;
        }

        $statistics->update($data);

        // تحديث التفاصيل بدون مسح الصور القديمة
        $existingDetails = $statistics->details()->get()->keyBy('id');

        $updatedDetails = $data['details'] ?? [];
        $newDetails = [];

        foreach ($updatedDetails as $key => $detail) {
            $iconPath = null;

            // تحقق من وجود id لتحديث الصف القديم
            $detailId = $detail['id'] ?? null;
            if ($detailId && $existingDetails->has($detailId)) {
                $existingDetail = $existingDetails->get($detailId);

                if (!empty($detail['icon']) && $detail['icon'] instanceof \Illuminate\Http\UploadedFile) {
                    if ($existingDetail->icon) Storage::disk('public')->delete($existingDetail->icon);
                    $iconPath = $detail['icon']->store('statistics/icons', 'public');
                } else {
                    $iconPath = $existingDetail->icon;
                }

                $existingDetail->update([
                    'number'            => $detail['number'] ?? 0,
                    'short_description' => $detail['short_description'] ?? [],
                    'description'       => $detail['description'] ?? [],
                    'icon'              => $iconPath,
                ]);

                $existingDetails->forget($detailId); // إزالة من القائمة لتجنب الحذف
            } else {
                if (!empty($detail['icon']) && $detail['icon'] instanceof \Illuminate\Http\UploadedFile) {
                    $iconPath = $detail['icon']->store('statistics/icons', 'public');
                }

                $newDetails[] = [
                    'number'            => $detail['number'] ?? 0,
                    'short_description' => $detail['short_description'] ?? [],
                    'description'       => $detail['description'] ?? [],
                    'icon'              => $iconPath,
                ];
            }
        }

        // إنشاء التفاصيل الجديدة فقط
        if (!empty($newDetails)) {
            $statistics->details()->createMany($newDetails);
        }

        // حذف أي تفاصيل لم تعد موجودة
        foreach ($existingDetails as $detailToDelete) {
            if ($detailToDelete->icon) Storage::disk('public')->delete($detailToDelete->icon);
            $detailToDelete->delete();
        }

        return redirect()->route('statistics.index')->with('ok', 'Updated');
    }

    public function destroy(Statistics $statistics)
    {
        if ($statistics->image) Storage::disk('public')->delete($statistics->image);
        foreach ($statistics->details as $detail) {
            if ($detail->icon) Storage::disk('public')->delete($detail->icon);
        }
        $statistics->details()->delete();
        $statistics->delete();
        return redirect()->route('statistics.index')->with('ok', 'Deleted');
    }

    public function toggleStatus(Statistics $statistics)
    {
        $statistics->status = $statistics->status ? 0 : 1;
        $statistics->save();
        if (request()->wantsJson()) return response()->json(['status' => $statistics->status]);
        return redirect()->back()->with('ok', 'Toggled');
    }

    public function updateOrder(Request $request)
    {
        $payload = $request->input('rows', $request->input('orders', $request->input('order', [])));

        if (!is_array($payload) || empty($payload)) return response()->json(['ok' => false, 'message' => 'No payload'], 422);

        $isList = array_keys($payload) === range(0, count($payload) - 1);

        $rows = [];
        if ($isList) {
            foreach ($payload as $row) {
                if (!isset($row['id'])) continue;
                $rows[(int)$row['id']] = (int)($row['order'] ?? 0);
            }
        } else {
            foreach ($payload as $id => $order) $rows[(int)$id] = (int)$order;
        }

        if (!$rows) return response()->json(['ok' => false, 'message' => 'No valid rows'], 422);

        foreach ($rows as $id => $ord) Statistics::whereKey($id)->update(['order' => $ord]);

        return response()->json(['ok' => true]);
    }
}
