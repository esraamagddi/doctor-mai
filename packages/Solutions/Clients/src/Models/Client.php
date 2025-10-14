<?php
namespace Solutions\Clients\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
    protected $fillable = [
        'name', 'slug', 'logo', 'email', 'phone', 'website', 'order', 'status'
    ];
    protected $casts = [
        'name' => 'array',
        'status' => 'boolean',
    ];
}
