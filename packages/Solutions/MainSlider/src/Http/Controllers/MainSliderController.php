<?php

namespace Solutions\MainSlider\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Solutions\MainSlider\Models\MainSlider;

class MainSliderController extends Controller
{
    private function resolveLocales(Request $request): array
    {
        try {
            $langs = \Solutions\Language\Models\Language::query()
                ->where('status', 1)
                ->orderBy('order')
                ->get(['code','name','dir','is_default']);
        } catch (\Throwable $e) {
            $langs = collect();
        }

        if ($langs->isEmpty()) {
            $langs = collect([
                (object)['code' => 'en', 'name' => 'English', 'dir' => 'ltr', 'is_default' => app()->getLocale() === 'en'],
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
        $perPage = (int)($request->get('per_page', 12));

        $items = DB::table('main_sliders')
            ->orderBy('order')
            ->paginate($perPage);

        $items->getCollection()->transform(function ($item) {
            $item->title        = $this->jsonToArray($item->title);
            $item->subtitle     = $this->jsonToArray($item->subtitle);
            $item->description  = $this->jsonToArray($item->description);
            $item->button1_text = $this->jsonToArray($item->button1_text ?? null);
            $item->button2_text = $this->jsonToArray($item->button2_text ?? null);
            return $item;
        });

        return view('main_slider::index', compact('items'));
    }

    public function create(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);

        return view('main_slider::create', compact('langs', 'activeLocale'));
    }

    public function store(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);

        $rules = $this->validationRules($langs);

        $data = $request->validate($rules);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/main_slider', 'public');
        }
        if ($request->hasFile('background_ar')) {
            $data['background_ar'] = $request->file('background_ar')->store('uploads/main_slider', 'public');
        }
        if ($request->hasFile('background_en')) {
            $data['background_en'] = $request->file('background_en')->store('uploads/main_slider', 'public');
        }

        foreach (['title', 'subtitle', 'description', 'button1_text', 'button2_text'] as $jsonField) {
            if (isset($data[$jsonField]) && is_array($data[$jsonField])) {
                $data[$jsonField] = json_encode($data[$jsonField], JSON_UNESCAPED_UNICODE);
            }
        }

        $data['status'] = $data['status'] ?? 1;
        $data['order']  = $data['order'] ?? (int)(DB::table('main_sliders')->max('order') + 1);

        DB::table('main_sliders')->insert(array_merge($data, [
            'created_at' => now(),
            'updated_at' => now(),
        ]));

        return redirect()->route('mainslider.index')->with('ok', 'Created');
    }

    public function edit(Request $request, $id)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);

        $mainSlider = DB::table('main_sliders')->where('id', $id)->first();
        if (!$mainSlider) {
            return redirect()->route('mainslider.index')->with('error', 'Not found');
        }

        $mainSlider->title        = $this->jsonToArray($mainSlider->title);
        $mainSlider->subtitle     = $this->jsonToArray($mainSlider->subtitle);
        $mainSlider->description  = $this->jsonToArray($mainSlider->description);
        $mainSlider->button1_text = $this->jsonToArray($mainSlider->button1_text ?? null);
        $mainSlider->button2_text = $this->jsonToArray($mainSlider->button2_text ?? null);

        return view('main_slider::edit', compact('mainSlider', 'langs', 'activeLocale'));
    }

    public function update(Request $request, $id)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);

        $rules = $this->validationRules($langs);
        $rules['edition_id'] = 'nullable|exists:editions,id'; 
        $data = $request->validate($rules);

        $mainSlider = DB::table('main_sliders')->where('id', $id)->first();
        if (!$mainSlider) {
            return redirect()->route('mainslider.index')->with('error', 'Not found');
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/main_slider', 'public');
        }
        if ($request->hasFile('background_ar')) {
            $data['background_ar'] = $request->file('background_ar')->store('uploads/main_slider', 'public');
        }
        if ($request->hasFile('background_en')) {
            $data['background_en'] = $request->file('background_en')->store('uploads/main_slider', 'public');
        }
        if ($request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('uploads/main_slider', 'public');
        }

        DB::table('main_sliders')->where('id', $id)->update(array_merge($data, [
            'updated_at' => now(),
        ]));

        return redirect()->route('mainslider.index')->with('ok', 'Updated');
    }

    public function destroy($id)
    {
        DB::table('main_sliders')->where('id', $id)->delete();
        return redirect()->route('mainslider.index')->with('ok', 'Deleted');
    }

    private function validationRules($langs)
    {
        $rules = [
            'title'            => 'required|array',
            'subtitle'         => 'nullable|array',
            'description'      => 'nullable|array',
            'image'            => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'background_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'video'            => 'nullable|file|mimes:mp4,mov,avi,wmv|max:10240',
            'video_url'        => 'nullable|url',
            'overlay_color'    => 'nullable|string',
            'button1_text'     => 'nullable|array',
            'button1_link'     => 'nullable|url',
            'button2_text'     => 'nullable|array',
            'button2_link'     => 'nullable|url',
            'order'            => 'nullable|integer',
            'status'           => 'nullable|boolean',
        ];

        foreach ($langs as $L) {
            $rules['title.' . $L->code]        = 'required|string';
            $rules['subtitle.' . $L->code]     = 'nullable|string';
            $rules['description.' . $L->code]  = 'nullable|string';
            $rules['button1_text.' . $L->code] = 'nullable|string';
            $rules['button2_text.' . $L->code] = 'nullable|string';
        }

        return $rules;
    }

    private function jsonToArray($field)
    {
        if (is_string($field)) {
            $decoded = json_decode($field, true);
            return is_array($decoded) ? $decoded : [];
        } elseif (is_array($field)) {
            return $field;
        }
        return [];
    }

    // Toggle slider status
    public function toggleStatus($id)
    {
        $slider = DB::table('main_sliders')->where('id', $id)->first();
        if (!$slider) {
            return redirect()->back()->with('error', 'Not found');
        }

        $newStatus = $slider->status ? 0 : 1;
        DB::table('main_sliders')->where('id', $id)->update(['status' => $newStatus]);

        if (request()->wantsJson()) {
            return response()->json(['status' => $newStatus]);
        }

        return redirect()->back()->with('ok', 'Toggled');
    }

    // Update slider order
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
                $rows[(int)$row['id']] = (int)($row['order'] ?? 0);
            }
        } else {
            foreach ($payload as $id => $order) {
                $rows[(int)$id] = (int)$order;
            }
        }

        if (!$rows) {
            return response()->json(['ok' => false, 'message' => 'No valid rows'], 422);
        }

        foreach ($rows as $id => $ord) {
            DB::table('main_sliders')->where('id', $id)->update(['order' => $ord]);
        }

        return response()->json(['ok' => true]);
    }
}
