<?php
namespace Solutions\Founder\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Solutions\Founder\Models\Founder;
use Illuminate\Support\Facades\Storage;

class FounderController extends Controller
{
    /** جلب اللغات المفعلة + تحديد التاب النشط */
    private function resolveLocales(Request $request): array
    {
        try {
            $langs = \Solutions\Language\Models\Language::query()
                ->where('status', 1)
                ->orderBy('order')
                ->get(['code','name','dir','is_default']);
        } catch (\Throwable $e) {
            $langs = collect([(object)['code'=>'en','name'=>'English','dir'=>'ltr','is_default'=>true]]);
        }

        $active = (string)$request->get('lang','');
        if (!$active) {
            $active = optional($langs->firstWhere('is_default',1))->code ?: app()->getLocale();
        }
        if (!$langs->contains('code',$active)) {
            $active = optional($langs->first())->code ?: 'en';
        }

        return [$langs, $active];
    }

    /** عرض صفحة Founder */
    public function index(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        $founder = Founder::first();
        return view('founder::index', compact('founder', 'langs', 'activeLocale'));
    }

    /** حفظ البيانات أو تحديثها */
    public function store(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);

        $rules = [
            'image'       => 'nullable|image|max:5120', // حتى 5 ميغابايت
            'email'       => 'nullable|email',
            'phone'       => 'nullable|string',
            'facebook'    => 'nullable|url',
            'twitter'     => 'nullable|url',
            'linkedin'    => 'nullable|url',
            'instagram'   => 'nullable|url',
            'youtube'     => 'nullable|url',
        ];

        // ✅ حقول متعددة اللغات
        foreach ($langs as $L) {
            $rules['name.'.$L->code]       = 'required|string';
            $rules['position.'.$L->code]   = 'nullable|string';
            $rules['short_desc.'.$L->code] = 'nullable|string';
            $rules['speech.'.$L->code]     = 'nullable|string';
        }

        $data = $request->validate($rules);

        $founder = Founder::first();

        // ✅ معالجة رفع الصورة
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('founder', 'public');

            if ($founder && $founder->image) {
                Storage::disk('public')->delete($founder->image);
            }

            $data['image'] = $imagePath;
        } elseif ($founder) {
            $data['image'] = $founder->image;
        }

        if ($founder) {
            $founder->update($data);
        } else {
            Founder::create($data);
        }

        return redirect()->route('founder.index')->with('ok', 'Saved');
    }

    /** حذف Founder */
    public function destroy(Founder $founder)
    {
        if ($founder->image) {
            Storage::disk('public')->delete($founder->image);
        }
        $founder->delete();
        return redirect()->route('founder.index')->with('ok', 'Deleted');
    }
}
