<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Solutions\Language\Models\Language;

class FrontLanguageController extends Controller
{
public function switch(Request $request, $code)
{
    $languages = Language::pluck('code')->toArray();
    $defaultLang = Language::where('is_default', 1)->value('code');

    if (!in_array($code, $languages)) {
        abort(404);
    }

    // حفظ اللغة في الجلسة
    session(['front_locale' => $code]);

    // محاولة إعادة التوجيه للصفحة الحالية
    $previousUrl = url()->previous();
    $previousPath = str_replace(url('/'), '', $previousUrl);
    $segments = explode('/', trim($previousPath, '/'));

    // إزالة prefix اللغة الحالي إذا موجود
    if (isset($segments[0]) && in_array($segments[0], $languages)) {
        array_shift($segments);
    }

    // إضافة prefix اللغة الجديد إذا ليست اللغة الافتراضية
    if ($code !== $defaultLang) {
        array_unshift($segments, $code);
    }

    // إذا الصفحة الرئيسية
    $newPath = '/' . implode('/', $segments);
    if ($newPath === '/') {
        $newPath = $code !== $defaultLang ? '/' . $code : '/';
    }

    return redirect($newPath);
}



    public static function getActiveLanguages()
    {
        return Language::where('status', 1)->orderBy('order')->get(['code', 'name','dir']);
    }
}
