<?php 
namespace Solutions\Faqs\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = ['question','answer','category_id','order','status','edition_id'];
    protected $casts = [
        'question' => 'array',
        'answer'   => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(FaqCategory::class, 'category_id');
    }
}
