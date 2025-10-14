<?php
namespace Solutions\Services\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Solutions\Services\Models\Service;
use Illuminate\Support\Facades\Storage;

class ServicesController extends Controller
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
        $items = Service::orderBy('order')->paginate($perPage);
        return view('services::index', compact('items'));
    }

    public function create(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        return view('services::create', compact('langs', 'activeLocale'));
    }

    public function store(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);

        $rules = [
            'name'        => 'required|array',
            'description' => 'nullable|array',
            'image'       => 'nullable|image|max:2048',
            'icon'        => 'nullable|image|max:1024',
            'status'      => 'nullable|boolean',
            'order'       => 'nullable|integer',
            'link'        => 'nullable|url',
        ];

        foreach ($langs as $L) {
            $rules['name.'.$L->code]        = 'required|string';
            $rules['description.'.$L->code] = 'nullable|string';
        }

        $data = $request->validate($rules);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services/images', 'public');
        }

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('services/icons', 'public');
        }

        $data['status'] = $data['status'] ?? 1;
        $data['order']  = $data['order'] ?? (int) (Service::max('order') + 1);

        Service::create($data);
        return redirect()->route('services.index')->with('ok', 'Created');
    }

    public function edit(Request $request, Service $service)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);

        if (old()) {
            foreach (array_keys((array) old('name', [])) as $k) {
                if ($k && $langs->contains('code', $k)) { $activeLocale = $k; break; }
            }
        }

        return view('services::edit', compact('service', 'langs', 'activeLocale'));
    }

    public function update(Request $request, Service $service)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);

        $rules = [
            'name'        => 'required|array',
            'description' => 'nullable|array',
            'image'       => 'nullable|image|max:2048',
            'icon'        => 'nullable|image|max:1024',
            'status'      => 'nullable|boolean',
            'order'       => 'nullable|integer',
            'link'        => 'nullable|url',
        ];

        foreach ($langs as $L) {
            $rules['name.'.$L->code]        = 'required|string';
            $rules['description.'.$L->code] = 'nullable|string';
        }

        $data = $request->validate($rules);

        if ($request->hasFile('image')) {
            if ($service->image) { Storage::disk('public')->delete($service->image); }
            $data['image'] = $request->file('image')->store('services/images', 'public');
        }

        if ($request->hasFile('icon')) {
            if ($service->icon) { Storage::disk('public')->delete($service->icon); }
            $data['icon'] = $request->file('icon')->store('services/icons', 'public');
        }

        $service->update($data);
        return redirect()->route('services.index')->with('ok', 'Updated');
    }

    public function destroy(Service $service)
    {
        if ($service->image) { Storage::disk('public')->delete($service->image); }
        if ($service->icon)  { Storage::disk('public')->delete($service->icon); }
        $service->delete();
        return redirect()->route('services.index')->with('ok', 'Deleted');
    }

    public function toggleStatus(Service $service)
    {
        $service->status = $service->status ? 0 : 1;
        $service->save();
        if (request()->wantsJson()) {
            return response()->json(['status' => $service->status]);
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
            Service::whereKey($id)->update(['order' => $ord]);
        }

        return response()->json(['ok' => true]);
    }

}
