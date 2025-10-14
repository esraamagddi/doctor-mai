<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Solutions\Faqs\Models\Faq;
use Solutions\Language\Models\Language;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $langs = Language::where('status',1)->orderBy('order')->get(['code','name','dir','is_default']);
        $activeLocale = session('front_locale', optional($langs->firstWhere('is_default',1))->code ?? app()->getLocale());

        $faqs = Faq::whereNull('edition_id')
            ->orderBy('order')
            ->get();

        foreach ($faqs as $f) {
            $f->question = is_array($f->question) ? $f->question : json_decode($f->question, true);
            $f->answer   = is_array($f->answer) ? $f->answer : json_decode($f->answer, true);
        }

       return view('front.faq.index', compact('langs','activeLocale','faqs'));

    }
}
