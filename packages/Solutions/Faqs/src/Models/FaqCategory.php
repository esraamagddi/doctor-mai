<?php 
namespace Solutions\Faqs\Models;

use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    protected $fillable = ['title','slug','order','status'];
    protected $casts = ['title' => 'array'];

    public function faqs()
    {
        return $this->hasMany(Faq::class, 'category_id');
    }
}
