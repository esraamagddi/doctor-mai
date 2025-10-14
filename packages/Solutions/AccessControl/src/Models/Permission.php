<?php

namespace Solutions\AccessControl\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['key','module','label'];
    public $timestamps = true;
}
