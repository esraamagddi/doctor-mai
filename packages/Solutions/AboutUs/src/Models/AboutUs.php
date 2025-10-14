<?php

namespace Solutions\AboutUs\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $fillable = [
        'title',
        'sub_title',
        'mission',
        'vision',
        'values',
        'goals',
        'history',
        'image',
        'video_url',
        'contact_email',
        'contact_phone',
        'vision_image',
        'goal_image',
        'stats_image',
        'stat1_title',
        'stat1_value',
        'stat1_description',
        'stat2_title',
        'stat2_value',
        'stat2_description',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'youtube',
        // New fields for Education & Qualifications
        'education_description',
        'education_degree',
        'education_degree_description',
        // New fields for Experience & Philosophy
        'experience_years',
        'treatment_techniques',
        'philosophy_quote',
        'philosophy_author',
    ];

    protected $casts = [
        'title'  => 'array',
        'sub_title' => 'array',
        'mission' => 'array',
        'vision' => 'array',
        'values' => 'array',
        'goals'  => 'array',
        'history' => 'array',
        'stat1_title'       => 'array',
        'stat1_value'       => 'array',
        'stat1_description' => 'array',
        'stat2_title'       => 'array',
        'stat2_value'       => 'array',
        'stat2_description' => 'array',
        // New multilingual fields
        'education_description' => 'array',
        'education_degree' => 'array',
        'education_degree_description' => 'array',
        'treatment_techniques' => 'array',
        'philosophy_quote' => 'array',
        'philosophy_author' => 'array',
    ];
}