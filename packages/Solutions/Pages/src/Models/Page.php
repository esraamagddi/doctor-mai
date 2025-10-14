<?php
namespace Solutions\Pages\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';

    protected $fillable = [
        'title', 'description', 'image', 'slug', 'status', 'order',
    ];

    protected $casts = [
        'title'       => 'array',
        'description' => 'array',
        'status'      => 'boolean',
        'order'       => 'integer',
    ];
}

