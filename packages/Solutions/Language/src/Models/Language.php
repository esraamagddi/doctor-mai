<?php
namespace Solutions\Language\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'name', 'code', 'dir', 'locale', 'order', 'status', 'is_default'
    ];

    protected $casts = [
        'status' => 'boolean',
        'is_default' => 'boolean',
        'order' => 'integer',
    ];
}
