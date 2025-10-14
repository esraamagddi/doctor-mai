<?php
namespace Solutions\Appointments\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Solutions\Appointments\Models\{Appointment, Patient, TimeSlot};
use Solutions\Services\Models\Service;
use Illuminate\Support\Str;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $q = Appointment::with(['patient', 'service'])->orderByDesc('id');
        if ($request->filled('date'))
            $q->whereDate('preferred_date', $request->date);
        if ($request->filled('status'))
            $q->where('status', $request->status);
        if ($request->filled('service_id'))
            $q->where('service_id', $request->service_id);
        $appointments = $q->paginate(20);
        $services = Service::orderBy('id')->get();
        return view('appointments::index', compact('appointments', 'services'));
    }

    public function create()
    {
        $patients = Patient::orderBy('id')->get();
        $services = Service::orderBy('id')->get();
        return view('appointments::create', compact('patients', 'services'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'service_id' => 'nullable|exists:services,id',
            'preferred_date' => 'required|date|after_or_equal:today',
            'preferred_time' => 'nullable|date_format:H:i',
            'notes' => 'nullable|string|max:2000',
        ]);
        $data['status'] = 'confirmed';
        Appointment::create($data);
        return redirect()->route('appointments.index')->with('success', 'Created');
    }

    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $patients = Patient::orderBy('id')->get();
        $services = Service::orderBy('id')->get();
        return view('appointments::edit', compact('appointment', 'patients', 'services'));
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $data = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'service_id' => 'nullable|exists:services,id',
            'preferred_date' => 'required|date',
            'preferred_time' => 'nullable|date_format:H:i',
            'status' => 'required|in:pending,confirmed,completed,canceled,no_show',
            'notes' => 'nullable|string|max:2000',
        ]);
        $appointment->update($data);
        return redirect()->route('appointments.index')->with('success', 'Updated');
    }

    public function destroy($id)
    {
        Appointment::findOrFail($id)->delete();
        return back()->with('success', 'Deleted');
    }

    public function confirm($id)
    {
        Appointment::findOrFail($id)->update(['status' => 'confirmed']);
        return back()->with('success', 'Confirmed');
    }
    public function cancel($id)
    {
        Appointment::findOrFail($id)->update(['status' => 'canceled']);
        return back()->with('success', 'Canceled');
    }
    public function complete($id)
    {
        Appointment::findOrFail($id)->update(['status' => 'completed']);
        return back()->with('success', 'Completed');
    }
}
