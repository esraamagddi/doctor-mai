<?php

use Illuminate\Support\Facades\App;

if (!function_exists('clanguage')) {
    function clanguage(): string
    {
        return App::getLocale() . '.';
    }
}

if (!function_exists('activeLangauge')) {
    function activeLangauge(): string
    {
        return App::getLocale();
    }
}

if (!function_exists('getSectionHeaders')) {
    function getSectionHeaders($slug)
    {
        return \Solutions\SectionHeaders\Models\SectionHeader::query()
            ->where('slug', $slug)
            ->first();
    }
}
if (!function_exists('getNavbar')) {
    function getNavbar()
    {
        return \Solutions\Navbar\Models\Navbar::query()
            ->where('status', true)
            ->orderBy('order')
            ->get();
    }
}
if (!function_exists('Setting')) {
    function Setting()
    {
        return \Solutions\SiteSetting\Models\SiteSetting::query()->first();
    }
}

if (!function_exists('Services')) {
    function Services()
    {
        return \Solutions\Services\Models\Service::query()
            ->where('status', true)
            ->orderBy('order')
            ->get();
    }
}



if (! function_exists('getLocalized')) {
    function getLocalized($value, ?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();

        if (empty($value)) {
            return '';
        }

        if (is_array($value)) {
            return $value[$locale] ?? reset($value) ?? '';
        }

        if (is_string($value)) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded[$locale] ?? reset($decoded) ?? '';
            }
        }

        return is_string($value) ? $value : '';
    }
}
