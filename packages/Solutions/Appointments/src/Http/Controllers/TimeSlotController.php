<?php
namespace Solutions\Appointments\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Solutions\Appointments\Models\{Appointment,Patient,Service,TimeSlot};
use Illuminate\Support\Str;

class TimeSlotController extends Controller
{
    public function index() { $slots = TimeSlot::orderBy('weekday')->orderBy('start_time')->get(); return view('appointments::timeslots_index', compact('slots')); }
    public function create() { return view('appointments::timeslots_create'); }
    public function store(Request $request) {
        $data = $request->validate([
            'weekday'=>'required|integer|min:0|max:6',
            'start_time'=>'required|date_format:H:i',
            'end_time'=>'required|date_format:H:i|after:start_time',
            'capacity'=>'required|integer|min:1|max:50',
            'is_active'=>'nullable|boolean',
        ]);
        TimeSlot::create($data + ['is_active'=>$request->boolean('is_active', true)]);
        return redirect()->route('timeslots.index')->with('success', __('appointments::messages.created'));
    }
    public function edit($id) { $slot = TimeSlot::findOrFail($id); return view('appointments::timeslots_edit', compact('slot')); }
    public function update(Request $request, $id) {
        $slot = TimeSlot::findOrFail($id);
        $data = $request->validate([
            'weekday'=>'required|integer|min:0|max:6',
            'start_time'=>'required|date_format:H:i',
            'end_time'=>'required|date_format:H:i|after:start_time',
            'capacity'=>'required|integer|min:1|max:50',
            'is_active'=>'nullable|boolean',
        ]);
        $slot->update($data + ['is_active'=>$request->boolean('is_active', $slot->is_active)]);
        return redirect()->route('timeslots.index')->with('success', __('appointments::messages.updated'));
    }
    public function destroy($id) { TimeSlot::findOrFail($id)->delete(); return back()->with('success', __('appointments::messages.deleted')); }
}
