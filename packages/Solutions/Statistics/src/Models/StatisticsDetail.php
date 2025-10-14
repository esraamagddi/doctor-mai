<?php 
namespace Solutions\Statistics\Models;

use Illuminate\Database\Eloquent\Model;

class StatisticsDetail extends Model
{
    protected $fillable = [
        'statistics_id','number','short_description','description','icon'
    ];

    protected $casts = [
        'short_description' => 'array',
        'description' => 'array',
    ];

    public function statistics()
    {
        return $this->belongsTo(Statistics::class);
    }
}
