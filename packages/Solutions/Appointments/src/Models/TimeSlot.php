<?php
namespace Solutions\Appointments\Models;

use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    protected $fillable = ['weekday','start_time','end_time','capacity','is_active'];
    protected $casts = ['is_active'=>'boolean'];
}
