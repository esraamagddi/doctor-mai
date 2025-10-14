<?php 
namespace Solutions\Statistics\Models;

use Illuminate\Database\Eloquent\Model;

class Statistics extends Model
{
    protected $fillable = [
        'title','short_description','description','image','order','status'
    ];

    protected $casts = [
        'title' => 'array',
        'short_description' => 'array',
        'description' => 'array',
        'status' => 'boolean',
    ];

    public function details()
    {
        return $this->hasMany(StatisticsDetail::class);
    }
}
