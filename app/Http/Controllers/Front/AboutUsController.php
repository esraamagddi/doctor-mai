<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Solutions\AboutUs\Models\AboutUs;
use Solutions\Founder\Models\Founder;
use Solutions\Language\Models\Language;
use Solutions\Statistics\Models\Statistics;

class AboutUsController extends Controller
{
    public function index(Request $request)
    {
        // 1) جلب كل اللغات المفعلة
        $langs = Language::where('status', 1)
            ->orderBy('order')
            ->get(['code', 'name', 'dir', 'is_default']);

        // 2) تحديد اللغة النشطة
        $activeLocale = session('front_locale', optional($langs->firstWhere('is_default', 1))->code ?? app()->getLocale());

        // 3) جلب "من نحن"
        $aboutUs = AboutUs::first();
        if ($aboutUs) {
            $multiLangFields = [
                'title',
                'sub_title',
                'mission',
                'vision',
                'values',
                'goals',
                'history',
                'stat1_title',
                'stat1_value',
                'stat1_description',
                'stat2_title',
                'stat2_value',
                'stat2_description',
                // الحقول الجديدة
                'education_description',
                'education_degree',
                'education_degree_description',
                'treatment_techniques',
                'philosophy_quote',
                'philosophy_author',
            ];
            
            foreach ($multiLangFields as $field) {
                if (isset($aboutUs->$field)) {
                    // فك JSON فقط إذا كانت قيمة نصية JSON
                    $aboutUs->$field = is_array($aboutUs->$field)
                        ? $aboutUs->$field
                        : (is_string($aboutUs->$field) && ($tmp = json_decode($aboutUs->$field, true)) && json_last_error() === JSON_ERROR_NONE
                            ? $tmp
                            : $aboutUs->$field);
                }
            }
        }

        // 4) جلب المؤسسين
        $founders = Founder::all();
        foreach ($founders as $founder) {
            foreach (['name', 'position', 'short_desc', 'speech'] as $field) {
                if (isset($founder->$field)) {
                    $founder->$field = is_array($founder->$field)
                        ? $founder->$field
                        : (is_string($founder->$field) && ($tmp = json_decode($founder->$field, true)) && json_last_error() === JSON_ERROR_NONE
                            ? $tmp
                            : $founder->$field);
                }
            }
        }

        // 5) جلب الإحصائيات + التفاصيل (eager loading)
        $statistics = Statistics::with(['details' => function ($q) {}])
            ->where('status', true)   // المفعّل فقط (اختياري)
            ->get();

        // فك JSON متعدد اللغات في الإحصائيات
        foreach ($statistics as $stat) {
            foreach (['title', 'short_description', 'description'] as $field) {
                if (isset($stat->$field)) {
                    $stat->$field = is_array($stat->$field)
                        ? $stat->$field
                        : (is_string($stat->$field) && ($tmp = json_decode($stat->$field, true)) && json_last_error() === JSON_ERROR_NONE
                            ? $tmp
                            : $stat->$field);
                }
            }

            // فك JSON متعدد اللغات في تفاصيل الإحصائيات (لو موجودة بهذه الحقول)
            foreach ($stat->details as $det) {
                foreach (['title', 'short_description', 'description'] as $field) {
                    if (isset($det->$field)) {
                        $det->$field = is_array($det->$field)
                            ? $det->$field
                            : (is_string($det->$field) && ($tmp = json_decode($det->$field, true)) && json_last_error() === JSON_ERROR_NONE
                                ? $tmp
                                : $det->$field);
                    }
                }
            }
        }

        // 6) إرسال البيانات إلى الفيو
        return view('front.aboutus.index', [
            'langs'         => $langs,
            'activeLocale'  => $activeLocale,
            'aboutUs'       => $aboutUs,
            'founders'      => $founders,
            'statistics'    => $statistics,
        ]);
    }
}