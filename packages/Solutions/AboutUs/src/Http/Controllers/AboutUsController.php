<?php

namespace Solutions\AboutUs\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Solutions\AboutUs\Models\AboutUs;
use Illuminate\Support\Facades\Storage;

class AboutUsController extends Controller
{
    /** جلب اللغات المفعلة + تحديد التاب النشط */
    private function resolveLocales(Request $request): array
    {
        $langs = \Solutions\Language\Models\Language::query()
            ->where('status', 1)
            ->orderBy('order')
            ->get(['code', 'name', 'dir', 'is_default']);

        if ($langs->isEmpty()) {
            $langs = collect([
                (object)['code' => 'en', 'name' => 'English', 'dir' => 'ltr', 'is_default' => app()->getLocale() === 'en'],
            ]);
        }

        $active = $request->get('lang') ?: optional($langs->firstWhere('is_default', 1))->code ?: app()->getLocale();

        if (!$langs->contains('code', $active)) {
            $active = optional($langs->first())->code ?: 'en';
        }

        return [$langs, $active];
    }

    /** عرض الفورم */
    public function index(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        $aboutUs = AboutUs::first();
        return view('aboutus::index', compact('aboutUs', 'langs', 'activeLocale'));
    }

    /** حفظ البيانات أو تحديثها */
    public function store(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);

        // قواعد التحقق
        $rules = [
            'image'        => 'nullable|image|max:5120',
            'vision_image' => 'nullable|image|max:5120',
            'goal_image'   => 'nullable|image|max:5120',
            'stats_image'  => 'nullable|image|max:5120',
            'video_url'    => 'nullable|url',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string',
            'facebook'     => 'nullable|string',
            'twitter'      => 'nullable|string',
            'linkedin'     => 'nullable|string',
            'instagram'    => 'nullable|string',
            'youtube'      => 'nullable|string',
            'experience_years' => 'nullable|integer|min:0',
        ];

        // الحقول متعددة اللغات
        foreach ($langs as $L) {
            $rules['title.' . $L->code]       = 'required|string';
            $rules['sub_title.' . $L->code]   = 'nullable|string';
            $rules['mission.' . $L->code]     = 'nullable|string';
            $rules['vision.' . $L->code]      = 'nullable|string';
            $rules['values.' . $L->code]      = 'nullable|string';
            $rules['goals.' . $L->code]       = 'nullable|string';
            $rules['history.' . $L->code]     = 'nullable|string';

            $rules['stat1_title.' . $L->code]       = 'nullable|string';
            $rules['stat1_value.' . $L->code]       = 'nullable|string';
            $rules['stat1_description.' . $L->code] = 'nullable|string';

            $rules['stat2_title.' . $L->code]       = 'nullable|string';
            $rules['stat2_value.' . $L->code]       = 'nullable|string';
            $rules['stat2_description.' . $L->code] = 'nullable|string';

            // New Education & Philosophy fields
            $rules['education_description.' . $L->code] = 'nullable|string';
            $rules['education_degree.' . $L->code] = 'nullable|string';
            $rules['education_degree_description.' . $L->code] = 'nullable|string';
            $rules['treatment_techniques.' . $L->code] = 'nullable|string';
            $rules['philosophy_quote.' . $L->code] = 'nullable|string';
            $rules['philosophy_author.' . $L->code] = 'nullable|string';
        }

        $data = $request->validate($rules);

        $aboutUs = AboutUs::first();

        // معالجة الصور
        foreach (['image', 'vision_image', 'goal_image', 'stats_image'] as $imgField) {
            if ($request->hasFile($imgField)) {
                $path = $request->file($imgField)->store('aboutus', 'public');
                if ($aboutUs && $aboutUs->$imgField) {
                    Storage::disk('public')->delete($aboutUs->$imgField);
                }
                $data[$imgField] = $path;
            } elseif ($aboutUs) {
                $data[$imgField] = $aboutUs->$imgField;
            }
        }

        // الحقول متعددة اللغات سيتم تحويلها تلقائيًا لـ JSON عبر $casts
        // لذلك لا حاجة لاستخدام json_encode هنا

        if ($aboutUs) {
            $aboutUs->update($data);
        } else {
            AboutUs::create($data);
        }

        return redirect()->route('aboutus.index')->with('ok', 'Saved');
    }

    /** حذف السجل */
    public function destroy(AboutUs $aboutUs)
    {
        foreach (['image', 'vision_image', 'goal_image', 'stats_image'] as $imgField) {
            if ($aboutUs->$imgField) {
                Storage::disk('public')->delete($aboutUs->$imgField);
            }
        }
        $aboutUs->delete();
        return redirect()->route('aboutus.index')->with('ok', 'Deleted');
    }
}