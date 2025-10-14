<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Solutions\Pages\Models\Page;

class PageController extends Controller
{
    public function show(string $slug)
    {
        $page = Page::where('status', true)
            ->where('slug', $slug)
            ->firstOrFail();

        $locale = session('front_locale', app()->getLocale());

        // Title من الـDB (متعدد اللغات)
        $title = '';
        if (is_array($page->title ?? null)) {
            $title = $page->title[$locale] ?? (reset($page->title) ?: '');
        } else {
            $title = (string) ($page->title ?? '');
        }

        // Content من الـDB (متعدد اللغات)
        $content = '';
        if (is_array($page->description ?? null)) {
            $content = $page->description[$locale] ?? (reset($page->description) ?: '');
        } else {
            $content = (string) ($page->description ?? '');
        }

        return view('front.pages.page', [
            'page'    => $page,
            'title'   => $title,
            'content' => $content,
            'locale'  => $locale,
        ]);
    }
}
