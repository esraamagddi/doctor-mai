<?php
namespace Solutions\Appointments\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Solutions\Appointments\Models\{Appointment,Patient,TimeSlot};
use Solutions\Services\Models\Service;
use Illuminate\Support\Str;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $q = Patient::query()->orderByDesc('id');
        if ($request->filled('phone')) $q->where('phone','like','%'.$request->phone.'%');
        if ($request->boolean('only_trashed')) $q->onlyTrashed();
        $patients = $q->paginate(20);
        return view('appointments::patients_index', compact('patients'));
    }

    public function create() { return view('appointments::patients_create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|array',
            'phone' => 'required|string|max:32',
            'email' => 'nullable|email',
            'gender'=>'nullable|in:male,female,other',
            'birthdate'=>'nullable|date',
            'file_number'=>'nullable|string|max:50',
            'notes'=>'nullable|string|max:2000',
        ]);
        $data['is_active'] = True;
        Patient::create($data);
        return redirect()->route('patients.index')->with('success', __('appointments::messages.created'));
    }

    public function edit($id) { $patient = Patient::findOrFail($id); return view('appointments::patients_edit', compact('patient')); }

    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);
        $data = $request->validate([
            'name'  => 'required|array',
            'phone' => 'required|string|max:32',
            'email' => 'nullable|email',
            'gender'=>'nullable|in:male,female,other',
            'birthdate'=>'nullable|date',
            'file_number'=>'nullable|string|max:50',
            'notes'=>'nullable|string|max:2000',
            'is_active'=>'nullable|boolean'
        ]);
        $patient->update($data);
        return redirect()->route('patients.index')->with('success', __('appointments::messages.updated'));
    }

    public function destroy($id) { Patient::findOrFail($id)->delete(); return back()->with('success', __('appointments::messages.deleted')); }

    public function restore($id) { $p = Patient::onlyTrashed()->findOrFail($id); $p->restore(); return back()->with('success', __('appointments::messages.restored')); }
}
