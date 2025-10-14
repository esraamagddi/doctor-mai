<?php

namespace Solutions\Clients\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Solutions\Clients\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    private function resolveLocales(Request $request): array
    {
        try {
            $langs = \Solutions\Language\Models\Language::query()
                ->where('status', 1)
                ->orderBy('order')
                ->get(['code', 'name', 'dir', 'is_default']);
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
        $q = Client::query();

        if ($s = $request->get('s')) {
            $q->where('slug', 'like', "%{$s}%");
            $q->orWhere('name->en', 'like', "%{$s}%");
            $q->orWhere('name->ar', 'like', "%{$s}%");
        }

        $items = $q->orderBy('order')->orderByDesc('id')->paginate((int)$request->get('per_page', 12));
        return view('clients::index', compact('items'));
    }

    public function create(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        return view('clients::create', compact('langs', 'activeLocale'));
    }

    public function store(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);

        $rules = [
            'name'    => 'required|array',
            'slug'    => 'nullable|string|max:200|unique:clients,slug',
            'logo'    => 'nullable|image|mimes:jpeg,jpg,png,gif,svg,webp|max:2048',
            'email'   => 'nullable|email|max:255',
            'phone'   => 'nullable|string|max:100',
            'website' => 'nullable|url|max:255',
            'order'   => 'nullable|integer|min:0',
            'status'  => 'nullable|boolean',
        ];

        foreach ($langs as $L) {
            $rules['name.'.$L->code] = 'required|string|max:200';
        }

        $data = $request->validate($rules);

        if (empty($data['slug'])) {
            $firstLangCode = $langs->first()->code ?? 'en';
            $data['slug'] = Str::slug($data['name'][$firstLangCode] ?? reset($data['name']) ?? 'client');
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('clients/logos', 'public');
            $data['logo'] = $logoPath;
        }

        $data['status'] = $data['status'] ?? 1;
        $data['order']  = $data['order'] ?? (int)(Client::max('order') + 1);

        Client::create($data);
        return redirect()->route('clients.index')->with('success', __('clients::t.created'));
    }

    public function edit(Request $request, Client $client)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);

        if (old()) {
            foreach (array_keys((array) old('name', [])) as $k) {
                if ($k && $langs->contains('code', $k)) {
                    $activeLocale = $k;
                    break;
                }
            }
        }

        return view('clients::edit', compact('client', 'langs', 'activeLocale'));
    }

    public function update(Request $request, Client $client)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);

        $rules = [
            'name'    => 'required|array',
            'slug'    => 'required|string|max:200|unique:clients,slug,' . $client->id,
            'logo'    => 'nullable|image|mimes:jpeg,jpg,png,gif,svg,webp|max:2048',
            'email'   => 'nullable|email|max:255',
            'phone'   => 'nullable|string|max:100',
            'website' => 'nullable|url|max:255',
            'order'   => 'nullable|integer|min:0',
            'status'  => 'nullable|boolean',
        ];

        foreach ($langs as $L) {
            $rules['name.'.$L->code] = 'required|string|max:200';
        }

        $data = $request->validate($rules);
        $data['status'] = $data['status'] ?? 0;

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($client->logo && Storage::disk('public')->exists($client->logo)) {
                Storage::disk('public')->delete($client->logo);
            }
            
            $logoPath = $request->file('logo')->store('clients/logos', 'public');
            $data['logo'] = $logoPath;
        }

        $client->update($data);
        return redirect()->route('clients.index')->with('success', __('clients::t.updated'));
    }

    public function destroy(Client $client)
    {
        // Delete logo if exists
        if ($client->logo && Storage::disk('public')->exists($client->logo)) {
            Storage::disk('public')->delete($client->logo);
        }
        
        $client->delete();
        return back()->with('success', __('clients::t.deleted'));
    }
}