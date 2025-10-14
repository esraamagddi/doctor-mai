<?php 
namespace Solutions\Team\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
protected $fillable = [
    'name', 'job_title', 'description', 'image', 'email', 'phone',
    'facebook', 'twitter', 'linkedin', 'instagram', 'youtube',
    'order', 'status', 'edition_id'
];

protected $casts = [
    'name' => 'array',
    'job_title' => 'array',
    'description' => 'array',
    'status' => 'boolean',
];

}
