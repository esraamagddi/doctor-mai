<?php 
namespace Solutions\Testimonial\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
   protected $fillable = [
    'name','job_title','description','image','email','phone','service','rating',
    'facebook','twitter','linkedin','instagram','youtube',
    'order','status'
];

protected $casts = [
    'name' => 'array',
    'job_title' => 'array',
    'description' => 'array',
    'service' => 'array',
    'rating' => 'integer',
    'status' => 'boolean',
];

}
