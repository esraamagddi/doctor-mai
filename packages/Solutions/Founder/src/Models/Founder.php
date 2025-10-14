<?php

namespace Solutions\Founder\Models;

use Illuminate\Database\Eloquent\Model;

class Founder extends Model
{
    protected $fillable = [
        'name', 'position', 'short_desc', 'speech', 'image',
        'email', 'phone', 'facebook', 'twitter', 'linkedin', 'instagram', 'youtube'
    ];

    protected $casts = [
        'name' => 'array',
        'position' => 'array',
        'short_desc' => 'array',
        'speech' => 'array'
    ];
}
