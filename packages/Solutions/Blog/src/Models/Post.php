<?php
namespace Solutions\Blog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'content',
        'description',
        'image',
        'tags',
        'category_id',
        'order',
        'status',
        'published_at',
        'author'
    ];

    protected $casts = [
        'title' => 'array',
        'content' => 'array',
        'description' => 'array',
        'tags' => 'array',
        'author' => 'array',
        'status' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Accessor لإظهار رابط الصورة بشكل كامل لو موجود
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/'.$this->image) : null;
    }
}
