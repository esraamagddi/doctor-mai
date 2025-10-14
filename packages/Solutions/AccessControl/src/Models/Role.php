<?php

namespace Solutions\AccessControl\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name','meta'];
    protected $casts = ['meta' => 'array'];
    public $timestamps = true;

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }
}
