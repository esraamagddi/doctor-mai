<?php

namespace Solutions\SiteSetting\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Solutions\SiteSetting\Models\SiteSetting;

class SiteSettingController extends Controller
{
    private function resolveLocales(): array
    {
        try {
            $langs = \Solutions\Language\Models\Language::query()
                ->where('status', 1)->orderBy('order')
                ->get(['code','name','dir','is_default']);
        } catch (\Throwable $e) {
            $langs = collect([
                (object)['code' => 'ar', 'name' => 'العربية', 'dir' => 'rtl', 'is_default' => 1],
                (object)['code' => 'en', 'name' => 'English', 'dir' => 'ltr', 'is_default' => 0],
            ]);
        }
        $active = request('lang') ?: ($langs->firstWhere('is_default', 1)->code ?? 'ar');
        return [$langs, $active];
    }

    public function edit()
    {
        [$langs, $active] = $this->resolveLocales();
        $setting = SiteSetting::query()->first();

        if (!$setting) {
            $setting = new SiteSetting([
                'site_name' => [],
                'site_tagline' => [],
                'site_description' => [],
                'address' => [],
                'social' => [],
                'working_hours' => [],
                'working_days' => [],
                'status' => true,
                'order' => 0,
            ]);
            $setting->save();
        }
        return view('sitesetting::edit', [
            'setting' => $setting,
            'langs' => $langs,
            'activeLocale' => $active,
        ]);
    }

    public function update(Request $request)
    {
        [$langs, $active] = $this->resolveLocales();
        $setting = SiteSetting::query()->firstOrFail();

        $rules = [
            'site_name'                 => 'required|array',
            'site_name.*'               => 'nullable|string|max:255',
            'site_tagline'              => 'nullable|array',
            'site_tagline.*'            => 'nullable|string|max:255',
            'site_description'          => 'nullable|array',
            'site_description.*'        => 'nullable|string',
            'address'                   => 'nullable|array',
            'address.*'                 => 'nullable|string|max:255',

            'contact_emails'            => 'nullable',
            'contact_phones'            => 'nullable',

            'social'                    => 'nullable|array',
            'social.*'                  => 'nullable|string|max:1024',

            'ga4_measurement_id'        => 'nullable|string|max:64',
            'gtm_container_id'          => 'nullable|string|max:64',
            'fb_pixel_id'               => 'nullable|string|max:64',

            'custom_head_code'          => 'nullable|string',
            'custom_body_code'          => 'nullable|string',
            'google_map_embed'          => 'nullable|string',

            'working_hours'             => 'nullable|array',
            'working_days' => 'nullable|max:1024',


            'logo_light'                => 'nullable|image',
            'logo_dark'                 => 'nullable|image',
            'favicon'                   => 'nullable|image',
        ];

        $data = $request->validate($rules);

        // Normalize status checkbox
        $data['status'] = (bool)($request->input('status', 0));
        // Map images
        foreach (['logo_light','logo_dark','favicon'] as $fileKey) {
            if ($request->hasFile($fileKey)) {
                $data[$fileKey] = $request->file($fileKey)->store('sitesetting', 'public');
            } else {
                unset($data[$fileKey]);
            }
        }

        $setting->fill($data)->save();

        cache()->forget('site.settings');

        return back()->with('ok', __('sitesetting::messages.updated'));
    }
}
