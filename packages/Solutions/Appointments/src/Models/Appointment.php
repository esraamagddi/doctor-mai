<?php
namespace Solutions\Appointments\Models;

use Illuminate\Database\Eloquent\Model;
use Solutions\Services\Models\Service; 
class Appointment extends Model
{
    protected $fillable = ['patient_id','service_id','preferred_date','preferred_time','status','notes'];
    protected $casts = ['preferred_date'=>'date'];
    public function patient(){ return $this->belongsTo(Patient::class); }
    public function service(){ return $this->belongsTo(Service::class); }
}
