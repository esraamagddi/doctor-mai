<?php
namespace Solutions\MainSlider\Models;

use Illuminate\Database\Eloquent\Model;

class MainSlider extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'image',
        'background_ar',
        'background_en',
        'video',
        'video_url',
        'button1_text',
        'button1_link',
        'button2_text',
        'button2_link',
        'overlay_color',
        'order',
        'status',
    ];

    protected $casts = [
        'title'        => 'array',
        'subtitle'     => 'array',
        'description'  => 'array',
        'button1_text' => 'array',
        'button2_text' => 'array',
        'status'       => 'boolean',
    ];
}
