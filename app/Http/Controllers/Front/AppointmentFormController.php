<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Solutions\Services\Models\Service;
use Solutions\Language\Models\Language;
use Solutions\Appointments\Models\Patient;
use Solutions\Appointments\Models\TimeSlot;
use Solutions\MainSlider\Models\MainSlider;
use Solutions\Appointments\Models\Appointment;

class AppointmentFormController extends Controller
{
    public function index()
    {
        $langs = Language::where('status', 1)
            ->orderBy('order')
            ->get(['code','name','dir','is_default']);

        $activeLocale = session(
            'front_locale',
            optional($langs->firstWhere('is_default', 1))->code ?? app()->getLocale()
        );

        $services = Service::where('status', true)
            ->orderBy('order')
            ->get(['id','name']);

        $services->transform(function ($s) {
            $raw = $s->getRawOriginal('name');
            if (is_string($raw)) {
                $s->name = $raw;
            } elseif (is_array($s->name)) {
                $s->name = json_encode($s->name, JSON_UNESCAPED_UNICODE);
            } else {
                $s->name = '{}';
            }
            return $s;
        });

        $time_slots = TimeSlot::where('is_active', true)
            ->orderBy('start_time')
            ->orderBy('weekday')
            ->get(['weekday','start_time','end_time']);
        $slider = MainSlider::first(); // or use where/order as needed

        return view('front.appointment.index', compact(
            'langs', 'activeLocale', 'services', 'time_slots','slider'
        ));
    }

    public function store(Request $request)
    {
        // نحفظ اللغة القادمة من الفورم أو من السيشن كنسخة احتياطية
        $lang = $request->input('_lang', session('front_locale', app()->getLocale()));

        $validated = $request->validate([
            'name'    => ['required','string','max:255'],
            'phone'   => ['required','string','max:50'],
            'email'   => ['nullable','email:rfc,dns','max:255'],
            'service' => ['required','integer','exists:services,id'],
            'date'    => ['required','date'],
            'time'    => ['required','string','max:10'],
            'message' => ['nullable','string'],
            // اختيارية: نتحقق من اللغة
            '_lang'   => ['nullable','in:ar,en'],
        ]);

        // تأكيد أن التوقيت موجود ومفعّل لليوم المطلوب
        $day     = Carbon::parse($validated['date'])->dayOfWeek; // 0..6
        $weekday = ($day === Carbon::SUNDAY) ? 1 : $day + 1;     // 1..7

        $slotExists = TimeSlot::where('is_active', true)
            ->where('weekday', $weekday)
            ->whereTime('start_time', '=', $validated['time'])
            ->exists();

        if (!$slotExists) {
            return back()
                ->withErrors(['time' => __('appointment.no_slots') ?: 'Selected time is unavailable.'])
                ->withInput();
        }

        // المريض
        $patient = Patient::firstOrCreate(
            ['phone' => $validated['phone']],
            [
                'name'      => [$lang => $validated['name']],
                'email'     => $validated['email'] ?? null,
                'is_active' => true,
            ]
        );

        if (is_array($patient->name)) {
            if (!array_key_exists($lang, $patient->name) || !$patient->name[$lang]) {
                $patient->name = array_merge($patient->name, [$lang => $validated['name']]);
                $patient->save();
            }
        } else {
            $patient->name = [$lang => $validated['name']];
            $patient->save();
        }

        // اسم الخدمة باللغة المختارة
        $label = 'Service';
        if ($service = Service::find($validated['service'])) {
            $raw = $service->getRawOriginal('name');
            $arr = is_string($raw) ? json_decode($raw, true) : (is_array($service->name) ? $service->name : null);
            if (json_last_error() === JSON_ERROR_NONE && is_array($arr)) {
                $label = $arr[$lang] ?? (reset($arr) ?: 'Service');
            }
        }

        // إنشاء الموعد
        $appointment = Appointment::create([
            'patient_id'     => $patient->id,
            'service_id'     => $validated['service'],
            'preferred_date' => $validated['date'],
            'preferred_time' => $validated['time'],
            'status'         => 'pending',
            'notes'          => $validated['message'] ?? null,
        ]);

        // توجيه لصفحة النجاح الصحيحة حسب اللغة
        return redirect()
            ->route($lang.'.appointment.success')
            ->with('appointment_summary', [
                'ref'           => $appointment->id,
                'name'          => $validated['name'],
                'phone'         => $validated['phone'],
                'email'         => $validated['email'] ?? null,
                'service_label' => $label,
                'date'          => $validated['date'],
                'time'          => $validated['time'],
            ]);
    }

    public function success()
    {
        if (!session()->has('appointment_summary')) {
            return redirect()->route(session('front_locale', app()->getLocale()) . '.appointment');
        }
        return view('front.appointment.success');
    }
}
