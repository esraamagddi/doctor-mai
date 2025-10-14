<?php
namespace Solutions\Navbar\Models;

use Illuminate\Database\Eloquent\Model;

class Navbar extends Model
{
    protected $table = 'navbar'; 
    
    protected $fillable = [
        'slug','title','icon','order','status','navbar_id'
    ];

    protected $casts = [
        'title' => 'array',
        'status' => 'boolean',
        'order' => 'integer',
    ];


}
