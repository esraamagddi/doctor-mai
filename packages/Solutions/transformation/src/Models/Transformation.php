<?php

namespace Solutions\Transformation\Models;

use Illuminate\Database\Eloquent\Model;

class Transformation extends Model
{
    protected $fillable = [
        'title',
        'description',
        'before_image',
        'after_image'
    ];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
    ];
}
