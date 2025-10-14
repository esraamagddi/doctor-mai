<?php

namespace Solutions\Seo\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Solutions\Seo\Models\Seo;

class SeoController extends Controller
{
    private function resolveLocales(Request $request): array
    {
        try {
            $langs = \Solutions\Language\Models\Language::query()
                ->where('status', 1)->orderBy('order')
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
        $items = Seo::orderBy('order')->orderByDesc('id')->paginate($perPage);
        return view('seo::index', compact('items'));
    }

    public function create(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        return view('seo::create', compact('langs', 'activeLocale'));
    }

    public function store(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);

        $clean = array_values(array_filter(
            array_map(function ($v) {
                if (is_null($v)) return null;
                if (is_scalar($v)) {
                    $s = trim((string)$v);
                    return $s === '' ? null : $s;
                }
                return null;
            }, (array) $request->input('robots_extra', []))
        ));
        $request->merge(['robots_extra' => $clean]);

        $slugRaw = (string) $request->input('slug', '');
        $slug = strtolower($slugRaw);
        $slug = str_replace(' ', '-', $slug);
        $slug = preg_replace('/[^a-z0-9._\-\/:]+/i', '-', $slug);
        $slug = preg_replace('/-+/', '-', $slug);
        $slug = preg_replace('#/{2,}#', '/', $slug);
        $slug = trim($slug, '-:/');
        $request->merge(['slug' => $slug]);

        $rules = [
            'slug'          => ['required','string','max:255','regex:/^[A-Za-z0-9\.\_\-\/:]+$/','unique:seo_pages,slug'],
            'canonical'     => ['nullable','url','max:1024'],
            'robots_index'  => ['nullable','boolean'],
            'robots_follow' => ['nullable','boolean'],
            'robots_extra'  => ['nullable','array'],
            'robots_extra.*'=> ['nullable','string','max:100'],
            'twitter_card'  => ['nullable', Rule::in(['summary','summary_large_image','app','player'])],
            'schema_type'   => ['nullable', Rule::in(['webpage','article','event','video','custom'])],
            'schema_json'   => ['nullable','json'],
            'hreflang'      => ['nullable','json'],
            'changefreq'    => ['nullable', Rule::in(['always','hourly','daily','weekly','monthly','yearly','never'])],
            'priority'      => ['nullable','numeric','between:0,1'],
            'order'         => ['nullable','integer','min:0'],
            'status'        => ['nullable','boolean'],
            'og_image'      => ['nullable','image','mimes:jpg,jpeg,png,webp,gif','max:8192'],
            'meta_title'        => ['required','array'],
            'meta_description'  => ['nullable','array'],
            'og_title'          => ['nullable','array'],
            'og_description'    => ['nullable','array'],
        ];

        foreach ($langs as $L) {
            $required = $L->is_default ? 'required' : 'nullable';
            $rules['meta_title.'.$L->code]       = $required.'|string|max:255';
            $rules['meta_description.'.$L->code] = 'nullable|string|max:500';
            $rules['og_title.'.$L->code]         = 'nullable|string|max:255';
            $rules['og_description.'.$L->code]   = 'nullable|string|max:500';
        }

        $data = $request->validate($rules);

        foreach (['schema_json','hreflang'] as $jsonField) {
            if (isset($data[$jsonField]) && $data[$jsonField] !== '') {
                $decoded = json_decode($data[$jsonField], true);
                if (json_last_error() !== JSON_ERROR_NONE || !is_array($decoded)) {
                    return back()->withErrors([$jsonField => 'Invalid JSON.'])->withInput();
                }
                $data[$jsonField] = $decoded;
            } else {
                $data[$jsonField] = null;
            }
        }

        if (is_array($data['hreflang'])) {
            foreach ($data['hreflang'] as $locale => $url) {
                if (!is_string($locale) || !is_string($url) || !filter_var($url, FILTER_VALIDATE_URL)) {
                    return back()->withErrors(['hreflang' => 'Invalid hreflang map. Use {"en":"https://...","ar":"https://..."} with valid URLs.'])->withInput();
                }
            }
        }

        if ($request->hasFile('og_image')) {
            $data['og_image'] = $request->file('og_image')->store('seo', 'public');
        }

        $data['robots_index']  = array_key_exists('robots_index', $data) ? (int)!!$data['robots_index'] : 1;
        $data['robots_follow'] = array_key_exists('robots_follow', $data) ? (int)!!$data['robots_follow'] : 1;
        $data['status']        = array_key_exists('status', $data) ? (int)!!$data['status'] : 1;
        $data['order']         = $data['order'] ?? (int) (Seo::max('order') + 1);
        $data['twitter_card']  = $data['twitter_card'] ?? 'summary_large_image';
        $data['schema_type']   = $data['schema_type'] ?? 'webpage';

        Seo::create($data);

        return redirect()->route('seo.index')->with('ok', __('seo::messages.save'));
    }

    public function edit(Request $request, Seo $page)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);

        if (old()) {
            foreach (array_keys((array) old('meta_title', [])) as $k) {
                if ($k && $langs->contains('code', $k)) { $activeLocale = $k; break; }
            }
        }

        return view('seo::edit', compact('page', 'langs', 'activeLocale'));
    }

    public function update(Request $request, Seo $page)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);

        $clean = array_values(array_filter(
            array_map(function ($v) {
                if (is_null($v)) return null;
                if (is_scalar($v)) {
                    $s = trim((string)$v);
                    return $s === '' ? null : $s;
                }
                return null;
            }, (array) $request->input('robots_extra', []))
        ));
        $request->merge(['robots_extra' => $clean]);

        $slugRaw = (string) $request->input('slug', '');
        $slug = strtolower($slugRaw);
        $slug = str_replace(' ', '-', $slug);
        $slug = preg_replace('/[^a-z0-9._\-\/:]+/i', '-', $slug);
        $slug = preg_replace('/-+/', '-', $slug);
        $slug = preg_replace('#/{2,}#', '/', $slug);
        $slug = trim($slug, '-:/');
        $request->merge(['slug' => $slug]);

        $rules = [
            'slug'          => ['required','string','max:255','regex:/^[A-Za-z0-9\.\_\-\/:]+$/','unique:seo_pages,slug,'.$page->id],
            'canonical'     => ['nullable','url','max:1024'],
            'robots_index'  => ['nullable','boolean'],
            'robots_follow' => ['nullable','boolean'],
            'robots_extra'  => ['nullable','array'],
            'robots_extra.*'=> ['nullable','string','max:100'],
            'twitter_card'  => ['nullable', Rule::in(['summary','summary_large_image','app','player'])],
            'schema_type'   => ['nullable', Rule::in(['webpage','article','event','video','custom'])],
            'schema_json'   => ['nullable','json'],
            'hreflang'      => ['nullable','json'],
            'changefreq'    => ['nullable', Rule::in(['always','hourly','daily','weekly','monthly','yearly','never'])],
            'priority'      => ['nullable','numeric','between:0,1'],
            'order'         => ['nullable','integer','min:0'],
            'status'        => ['nullable','boolean'],
            'og_image'      => ['nullable','image','mimes:jpg,jpeg,png,webp,gif','max:8192'],
            'meta_title'        => ['required','array'],
            'meta_description'  => ['nullable','array'],
            'og_title'          => ['nullable','array'],
            'og_description'    => ['nullable','array'],
        ];

        foreach ($langs as $L) {
            $required = $L->is_default ? 'required' : 'nullable';
            $rules['meta_title.'.$L->code]       = $required.'|string|max:255';
            $rules['meta_description.'.$L->code] = 'nullable|string|max:500';
            $rules['og_title.'.$L->code]         = 'nullable|string|max:255';
            $rules['og_description.'.$L->code]   = 'nullable|string|max:500';
        }

        $data = $request->validate($rules);

        foreach (['schema_json','hreflang'] as $jsonField) {
            if (isset($data[$jsonField]) && $data[$jsonField] !== '') {
                $decoded = json_decode($data[$jsonField], true);
                if (json_last_error() !== JSON_ERROR_NONE || !is_array($decoded)) {
                    return back()->withErrors([$jsonField => 'Invalid JSON.'])->withInput();
                }
                $data[$jsonField] = $decoded;
            } else {
                $data[$jsonField] = null;
            }
        }

        if (is_array($data['hreflang'])) {
            foreach ($data['hreflang'] as $locale => $url) {
                if (!is_string($locale) || !is_string($url) || !filter_var($url, FILTER_VALIDATE_URL)) {
                    return back()->withErrors(['hreflang' => 'Invalid hreflang map. Use {"en":"https://...","ar":"https://..."} with valid URLs.'])->withInput();
                }
            }
        }

        if ($request->hasFile('og_image')) {
            $data['og_image'] = $request->file('og_image')->store('seo', 'public');
        } else {
            unset($data['og_image']);
        }

        $data['robots_index']  = array_key_exists('robots_index', $data) ? (int)!!$data['robots_index'] : $page->robots_index;
        $data['robots_follow'] = array_key_exists('robots_follow', $data) ? (int)!!$data['robots_follow'] : $page->robots_follow;
        $data['status']        = array_key_exists('status', $data) ? (int)!!$data['status'] : $page->status;

        $page->update($data);

        return redirect()->route('seo.index')->with('ok', __('seo::messages.update'));
    }

    public function destroy(Seo $page)
    {
        $page->delete();
        return redirect()->route('seo.index')->with('ok', __('seo::messages.delete'));
    }

    public function toggleStatus(Seo $page)
    {
        $page->status = $page->status ? 0 : 1;
        $page->save();

        if (request()->wantsJson()) {
            return response()->json(['status' => $page->status]);
        }
        return back()->with('ok', 'Toggled');
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
            Seo::whereKey($id)->update(['order' => $ord]);
        }

        return response()->json(['ok' => true]);
    }
}
