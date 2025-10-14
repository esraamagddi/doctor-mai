<?php

namespace Solutions\SiteSetting\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class SiteSetting extends Model
{
    protected $table = 'site_settings';

    protected $fillable = [
        // Multilingual
        'site_name','site_tagline','site_description','address',
        // Media
        'logo_light','logo_dark','favicon',
        // Social & contact
        'social','contact_emails','contact_phones',
        // Analytics / Pixels
        'ga4_id','gtm_id','fb_pixel_id',
        // Custom code
        'custom_head','custom_body',
        // Controls
        'order','status',
        // Extras
        'working_hours','working_days','google_map_embed',
        
    ];

    protected $casts = [
        'site_name'         => 'array',
        'site_tagline'      => 'array',
        'site_description'  => 'array',
        'address'           => 'array',
        'social'            => 'array',
        'contact_emails'    => 'array',
        'contact_phones'    => 'array',
        'working_hours'     => 'array',
        'status'            => 'boolean',
        'order'             => 'integer',
        'working_days' => 'array',
    ];

    /**
     * Virtual attribute: ga4_measurement_id <-> ga4_id
     */
    protected function ga4MeasurementId(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['ga4_id'] ?? null,
            set: fn ($value) => ['ga4_id' => $value]
        );
    }

    /**
     * Virtual attribute: gtm_container_id <-> gtm_id
     */
    protected function gtmContainerId(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['gtm_id'] ?? null,
            set: fn ($value) => ['gtm_id' => $value]
        );
    }

    /**
     * Virtual attribute: custom_head_code <-> custom_head
     */
    protected function customHeadCode(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['custom_head'] ?? null,
            set: fn ($value) => ['custom_head' => $value]
        );
    }

    /**
     * Virtual attribute: custom_body_code <-> custom_body
     */
    protected function customBodyCode(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['custom_body'] ?? null,
            set: fn ($value) => ['custom_body' => $value]
        );
    }

    /**
     * Virtual attribute: emails (CSV string or array) <-> contact_emails (array)
     * Getter returns array for convenience in the Blade.
     */
    protected function emails(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => isset($attributes['contact_emails'])
                ? (is_string($attributes['contact_emails']) ? json_decode($attributes['contact_emails'], true) : $attributes['contact_emails'])
                : [],
            set: function ($value) {
                if (is_string($value)) {
                    $arr = array_values(array_filter(array_map('trim', explode(',', $value))));
                } elseif (is_array($value)) {
                    $arr = array_values(array_filter(array_map('trim', $value)));
                } else {
                    $arr = [];
                }
                return ['contact_emails' => $arr];
            }
        );
    }

    /**
     * Virtual attribute: phones (CSV string or array) <-> contact_phones (array)
     * Getter returns array for convenience in the Blade.
     */
    protected function phones(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => isset($attributes['contact_phones'])
                ? (is_string($attributes['contact_phones']) ? json_decode($attributes['contact_phones'], true) : $attributes['contact_phones'])
                : [],
            set: function ($value) {
                if (is_string($value)) {
                    $arr = array_values(array_filter(array_map('trim', explode(',', $value))));
                } elseif (is_array($value)) {
                    $arr = array_values(array_filter(array_map('trim', $value)));
                } else {
                    $arr = [];
                }
                return ['contact_phones' => $arr];
            }
        );
    }
}
