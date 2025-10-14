<?php
namespace Solutions\Media\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'videos';
    protected $fillable = ['title','description','video_url','image','order','status','embed_code','category_id'];
    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'status' => 'boolean',
        'order' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(\Solutions\Media\Models\VideoCategory::class, 'category_id');
    }
}
