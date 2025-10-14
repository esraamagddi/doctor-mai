<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Registration;
use Illuminate\Support\Facades\Storage;

class RegistrationController extends Controller
{
    // دالة عرض صفحة التسجيل
    public function show()
    {
        return view('front.register.index');
    }

    // دالة تخزين البيانات
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:registrations,email',
            'phoneNumber' => 'required|string|max:50',
            'gender' => 'required|string|max:10',
            'nationality' => 'required|string|max:100',
            'countryOfResidence' => 'required|string|max:100',
            'age' => 'required|string|max:10', // هيجي نص من الفورم
            'preferredLanguage' => 'required|string|max:10',
            'educationalQualification' => 'required|string|max:255',
            'currentJob' => 'required|string|max:255',
            'workplace' => 'required|string|max:255',
            'typeOfWork' => 'required|string|max:255',
            'IDnumber' => 'required|string|max:255',
            'IDissueDate' => 'required|date',
            'IDExpiryDate' => 'required|date|after_or_equal:IDissueDate',
            'IDphoto' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'q1' => 'nullable|in:0,1',
            'q1Text' => 'nullable|string',
            'q2' => 'nullable|in:0,1',
            'q2Text' => 'nullable|string',
            'q3' => 'nullable|in:0,1',
            'q3Text' => 'nullable|string',
            'q4' => 'nullable|in:0,1',
            'q4Text' => 'nullable|string',
            'participationType' => 'required|string|max:255',
            'participationTypeUpload' => 'required|file|mimes:pdf|max:2048',
        ]);

        try {
            DB::beginTransaction();

            // تحويل age لنوع integer لو هو نص
            $age = is_numeric($validatedData['age']) ? intval($validatedData['age']) : 0;

            // حفظ الملفات
            $idPhotoPath = $request->file('IDphoto')->store('register', 'public');
            $participationFilePath = $request->file('participationTypeUpload')->store('register', 'public');

            // تخزين البيانات في قاعدة البيانات
            Registration::create([
                'full_name' => $validatedData['fullName'],
                'email' => $validatedData['email'],
                'phone_number' => $validatedData['phoneNumber'],
                'gender' => $validatedData['gender'],
                'nationality' => $validatedData['nationality'],
                'country_of_residence' => $validatedData['countryOfResidence'],
                'age' => $age,
                'preferred_language' => $validatedData['preferredLanguage'],
                'educational_qualification' => $validatedData['educationalQualification'],
                'current_job' => $validatedData['currentJob'],
                'workplace' => $validatedData['workplace'],
                'type_of_work' => $validatedData['typeOfWork'],
                'id_number' => $validatedData['IDnumber'],
                'id_issue_date' => $validatedData['IDissueDate'],
                'id_expiry_date' => $validatedData['IDExpiryDate'],
                'id_photo' => $idPhotoPath,
                'q1_answer' => isset($validatedData['q1']) ? (bool)$validatedData['q1'] : null,
                'q1_text' => $validatedData['q1Text'] ?? null,
                'q2_answer' => isset($validatedData['q2']) ? (bool)$validatedData['q2'] : null,
                'q2_text' => $validatedData['q2Text'] ?? null,
                'q3_answer' => isset($validatedData['q3']) ? (bool)$validatedData['q3'] : null,
                'q3_text' => $validatedData['q3Text'] ?? null,
                'q4_answer' => isset($validatedData['q4']) ? (bool)$validatedData['q4'] : null,
                'q4_text' => $validatedData['q4Text'] ?? null,
                'participation_type' => $validatedData['participationType'],
                'participation_type_file' => $participationFilePath,
            ]);

            DB::commit();

            return redirect()->route('register')->with('success', 'تم التسجيل بنجاح.');
        } catch (\Exception $e) {
            DB::rollBack();

            // حذف الملفات لو حصل خطأ
            if (isset($idPhotoPath)) {
                Storage::disk('public')->delete($idPhotoPath);
            }
            if (isset($participationFilePath)) {
                Storage::disk('public')->delete($participationFilePath);
            }

            return back()->withErrors(['error' => 'حدث خطأ أثناء تخزين البيانات: ' . $e->getMessage()]);
        }
    }
}
