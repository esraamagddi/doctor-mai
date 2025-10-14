<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Solutions\Language\Models\Language;
use Solutions\Contact\Models\ContactMessage;

class ContactController extends Controller
{
    public function index()
    {
        // تجهيز اللغات واللغة النشطة (لو بتحتاجيهم في الواجهة)
        $langs = Language::where('status', 1)
            ->orderBy('order')
            ->get(['code','name','dir','is_default']);

        $activeLocale = session('front_locale', optional(
            $langs->firstWhere('is_default', 1)
        )->code ?? app()->getLocale());

        return view('front.contact.index', compact('langs', 'activeLocale'));
    }

    public function store(Request $request)
    {
        $lang = $request->input('_lang', session('front_locale', app()->getLocale()));
        
        // مطابق للفورم
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'phone'   => ['required', 'string', 'max:50'],
            'email'   => ['nullable', 'email:rfc,dns', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        // العنوان: عنوان افتراضي مترجم
        $subject = __('contact.default_subject', [], $lang) ?: 'Contact Form Submission';

        // إنشاء الرسالة
        $msg = ContactMessage::create([
            'name'        => $validated['name'],
            'email'       => $validated['email'] ?? null,
            'phone'       => $validated['phone'],
            'subject'     => $subject,
            'message'     => $validated['message'],
            'meta'        => [
                'from'       => 'contact_form',
                'ip'         => $request->ip(),
                'user_agent' => $request->userAgent(),
                'locale'     => session('front_locale', app()->getLocale()),
            ],
            'attachments' => [],
            'is_read'     => false,
            'status'      => 1,
        ]);

        // تحويل لصفحة النجاح مع تمرير الملخص
        return redirect()
            ->route($lang . '.contact.success')
            ->with('contact_summary', [
                'ref'     => $msg->id,
                'name'    => $validated['name'],
                'phone'   => $validated['phone'],
                'email'   => $validated['email'] ?? null,
                'subject' => $subject,
                'message' => $validated['message'],
                'sent_at' => now()->toDateTimeString(),
            ]);
    }

    // صفحة نجاح إرسال نموذج التواصل
    public function success()
    {
        // لو اتفتحت مباشرة بدون بيانات، ارجعي لصفحة الاتصال
        if (!session()->has('contact_summary')) {
            return redirect()->route(session('front_locale', app()->getLocale()) . '.contact');
        }

        return view('front.contact.success');
    }
}