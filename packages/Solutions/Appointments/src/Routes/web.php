<?php
use Illuminate\Support\Facades\Route;
use Solutions\Appointments\Http\Controllers\{AppointmentController,PatientController,TimeSlotController};

Route::middleware(['web','auth'])->group(function () {

    // Appointments
    Route::prefix('cp/appointments')->group(function () {
        Route::get('/',          [AppointmentController::class, 'index'])->name('appointments.index')->middleware('perm:appointments.appointments.view');
        Route::get('/create',    [AppointmentController::class, 'create'])->name('appointments.create')->middleware('perm:appointments.appointments.create');
        Route::post('/',         [AppointmentController::class, 'store'])->name('appointments.store')->middleware('perm:appointments.appointments.create');
        Route::get('/{id}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit')->middleware('perm:appointments.appointments.edit');
        Route::put('/{id}',      [AppointmentController::class, 'update'])->name('appointments.update')->middleware('perm:appointments.appointments.edit');
        Route::delete('/{id}',   [AppointmentController::class, 'destroy'])->name('appointments.destroy')->middleware('perm:appointments.appointments.delete');

        Route::post('/{id}/confirm',  [AppointmentController::class, 'confirm'])->name('appointments.confirm')->middleware('perm:appointments.appointments.edit');
        Route::post('/{id}/cancel',   [AppointmentController::class, 'cancel'])->name('appointments.cancel')->middleware('perm:appointments.appointments.edit');
        Route::post('/{id}/complete', [AppointmentController::class, 'complete'])->name('appointments.complete')->middleware('perm:appointments.appointments.edit');
    });

    // Patients
    Route::prefix('cp/patients')->group(function () {
        Route::get('/',          [PatientController::class, 'index'])->name('patients.index')->middleware('perm:appointments.patients.view');
        Route::get('/create',    [PatientController::class, 'create'])->name('patients.create')->middleware('perm:appointments.patients.create');
        Route::post('/',         [PatientController::class, 'store'])->name('patients.store')->middleware('perm:appointments.patients.create');
        Route::get('/{id}/edit', [PatientController::class, 'edit'])->name('patients.edit')->middleware('perm:appointments.patients.edit');
        Route::put('/{id}',      [PatientController::class, 'update'])->name('patients.update')->middleware('perm:appointments.patients.edit');
        Route::delete('/{id}',   [PatientController::class, 'destroy'])->name('patients.destroy')->middleware('perm:appointments.patients.delete');
        Route::post('/{id}/restore', [PatientController::class, 'restore'])->name('patients.restore')->middleware('perm:appointments.patients.edit');
    });


    // Time slots
    Route::prefix('cp/timeslots')->group(function () {
        Route::get('/',          [TimeSlotController::class, 'index'])->name('timeslots.index')->middleware('perm:appointments.timeslots.manage');
        Route::get('/create',    [TimeSlotController::class, 'create'])->name('timeslots.create')->middleware('perm:appointments.timeslots.manage');
        Route::post('/',         [TimeSlotController::class, 'store'])->name('timeslots.store')->middleware('perm:appointments.timeslots.manage');
        Route::get('/{id}/edit', [TimeSlotController::class, 'edit'])->name('timeslots.edit')->middleware('perm:appointments.timeslots.manage');
        Route::put('/{id}',      [TimeSlotController::class, 'update'])->name('timeslots.update')->middleware('perm:appointments.timeslots.manage');
        Route::delete('/{id}',   [TimeSlotController::class, 'destroy'])->name('timeslots.destroy')->middleware('perm:appointments.timeslots.manage');
    });
});
