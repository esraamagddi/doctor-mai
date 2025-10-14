<?php
namespace Solutions\Media\Models;

use Illuminate\Database\Eloquent\Model;

class VideoCategory extends Model
{
    protected $table = 'video_categories';
    protected $fillable = ['name','order','status'];
    protected $casts = [
        'name' => 'array',
        'order' => 'integer',
        'status' => 'boolean',
    ];

    public function videos()
    {
        return $this->hasMany(Video::class, 'category_id');
    }
}
