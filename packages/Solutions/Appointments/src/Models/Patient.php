<?php
namespace Solutions\Appointments\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use SoftDeletes;
    protected $fillable = ['name','phone','email','gender','birthdate','file_number','notes','is_active'];
    protected $casts = ['name'=>'array','is_active'=>'boolean','birthdate'=>'date'];
    public function appointments(){ return $this->hasMany(Appointment::class); }
}
