<?php

namespace Solutions\Seo\Models;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $table = 'seo_pages';

    protected $fillable = [
        'slug',
        'meta_title',
        'meta_description',
        'og_title',
        'og_description',
        'canonical',
        'og_image',
        'robots_index',
        'robots_follow',
        'robots_extra',
        'twitter_card',
        'schema_type',
        'schema_json',
        'hreflang',
        'changefreq',
        'priority',
        'order',
        'status',
    ];

    protected $casts = [
        'meta_title'        => 'array',
        'meta_description'  => 'array',
        'og_title'          => 'array',
        'og_description'    => 'array',
        'robots_index'      => 'boolean',
        'robots_follow'     => 'boolean',
        'robots_extra'      => 'array',
        'schema_json'       => 'array',
        'hreflang'          => 'array',
        'priority'          => 'float',
        'status'            => 'boolean',
    ];
}
