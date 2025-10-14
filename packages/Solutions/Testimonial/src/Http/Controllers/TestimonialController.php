<?php

namespace Solutions\Testimonial\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Solutions\Testimonial\Models\Testimonial;
use Solutions\Language\Models\Language;

class TestimonialController extends Controller
{
    private function resolveLocales(Request $request): array
    {
        try {
            $langs = Language::query()
                ->where('status', 1)
                ->orderBy('order')
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

    public function index(Request $request)
    {
        $perPage = (int) ($request->get('per_page', 12));
        $items = Testimonial::orderBy('order')->paginate($perPage);
        return view('testimonial::index', compact('items'));
    }

    public function create(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        return view('testimonial::create', compact('langs', 'activeLocale'));
    }

    public function store(Request $request)
    {
        [$langs] = $this->resolveLocales($request);

        $rules = [
            'edition_id' => 'nullable|exists:editions,id',
            'name' => 'required|array',
            'job_title' => 'nullable|array',
            'description' => 'nullable|array',
            'service' => 'nullable|array',
            'rating' => 'nullable|integer|min:1|max:5',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'order' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ];

        foreach ($langs as $L) {
            $rules['name.' . $L->code] = 'required|string|max:255';
            $rules['job_title.' . $L->code] = 'nullable|string|max:255';
            $rules['description.' . $L->code] = 'nullable|string';
            $rules['service.' . $L->code] = 'nullable|string';
        }

        $data = $request->validate($rules);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('testimonials', 'public');
        }

        $data['status'] = $data['status'] ?? 1;
        $data['order'] = $data['order'] ?? (int) (Testimonial::max('order') + 1);

        DB::table('testimonials')->insert([
            'name' => json_encode($data['name'], JSON_UNESCAPED_UNICODE),
            'job_title' => json_encode($data['job_title'] ?? [], JSON_UNESCAPED_UNICODE),
            'description' => json_encode($data['description'] ?? [], JSON_UNESCAPED_UNICODE),
            'service' => json_encode($data['service'] ?? [], JSON_UNESCAPED_UNICODE),
            'rating' => $data['rating'] ?? null,
            'image' => $data['image'] ?? null,
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'facebook' => $data['facebook'] ?? null,
            'twitter' => $data['twitter'] ?? null,
            'linkedin' => $data['linkedin'] ?? null,
            'instagram' => $data['instagram'] ?? null,
            'youtube' => $data['youtube'] ?? null,
            'order' => $data['order'],
            'status' => $data['status'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('testimonial.index')->with('ok', 'Created');
    }

    public function edit(Request $request, Testimonial $testimonial)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        return view('testimonial::edit', compact('testimonial', 'langs', 'activeLocale'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        [$langs] = $this->resolveLocales($request);

        $rules = [
            'edition_id' => 'nullable|exists:editions,id',
            'name' => 'required|array',
            'job_title' => 'nullable|array',
            'description' => 'nullable|array',
            'service' => 'nullable|array',
            'rating' => 'nullable|integer|min:1|max:5',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'order' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ];

        foreach ($langs as $L) {
            $rules['name.' . $L->code] = 'required|string|max:255';
            $rules['job_title.' . $L->code] = 'nullable|string|max:255';
            $rules['description.' . $L->code] = 'nullable|string';
            $rules['service.' . $L->code] = 'nullable|string';
        }

        $data = $request->validate($rules);

        if ($request->hasFile('image')) {
            if ($testimonial->image) {
                Storage::disk('public')->delete($testimonial->image);
            }
            $data['image'] = $request->file('image')->store('testimonials', 'public');
        } else {
            $data['image'] = $testimonial->image;
        }

        $data['status'] = $data['status'] ?? $testimonial->status;

        DB::table('testimonials')->where('id', $testimonial->id)->update([
            'name' => json_encode($data['name'], JSON_UNESCAPED_UNICODE),
            'job_title' => json_encode($data['job_title'] ?? [], JSON_UNESCAPED_UNICODE),
            'description' => json_encode($data['description'] ?? [], JSON_UNESCAPED_UNICODE),
            'service' => json_encode($data['service'] ?? [], JSON_UNESCAPED_UNICODE),
            'rating' => $data['rating'] ?? null,
            'image' => $data['image'] ?? null,
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'facebook' => $data['facebook'] ?? null,
            'twitter' => $data['twitter'] ?? null,
            'linkedin' => $data['linkedin'] ?? null,
            'instagram' => $data['instagram'] ?? null,
            'youtube' => $data['youtube'] ?? null,
            'order' => $data['order'] ?? $testimonial->order,
            'status' => $data['status'],
            'updated_at' => now(),
        ]);

        return redirect()->route('testimonial.index')->with('ok', 'Updated');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->image) {
            Storage::disk('public')->delete($testimonial->image);
        }
        DB::table('testimonials')->where('id', $testimonial->id)->delete();

        return back()->with('ok', 'Deleted');
    }

    public function toggleStatus(Testimonial $testimonial)
    {
        $testimonial->status = $testimonial->status ? 0 : 1;
        $testimonial->save();

        if (request()->wantsJson()) {
            return response()->json(['status' => $testimonial->status]);
        }

        return redirect()->back()->with('ok', 'Toggled');
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
            Testimonial::whereKey($id)->update(['order' => $ord]);
        }

        return response()->json(['ok' => true]);
    }
}
