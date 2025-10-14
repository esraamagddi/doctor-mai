<?php

namespace Solutions\Media\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photos';
    protected $fillable = ['title', 'description', 'image', 'order', 'status'];
    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'status' => 'boolean',
        'order' => 'integer',
    ];
}
