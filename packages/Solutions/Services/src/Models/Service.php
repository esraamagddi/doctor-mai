<?php
namespace Solutions\Services\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name','description','image','icon','pdf','link',
        'features','social_links','tags','order','status'
    ];

    protected $casts = [
        'name' => 'array',
        'description' => 'array',
        'features' => 'array',
        'social_links' => 'array',
        'tags' => 'array',
        'status' => 'boolean',
    ];
}
