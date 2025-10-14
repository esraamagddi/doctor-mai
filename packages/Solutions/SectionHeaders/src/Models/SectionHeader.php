<?php
namespace Solutions\SectionHeaders\Models;

use Illuminate\Database\Eloquent\Model;

class SectionHeader extends Model
{
    protected $fillable = [
        'slug','eyebrow','title','description','icon','order','status','parent_id'
    ];

    protected $casts = [
        'eyebrow' => 'array',
        'title' => 'array',
        'description' => 'array',
        'status' => 'boolean',
        'order' => 'integer',
    ];



    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
