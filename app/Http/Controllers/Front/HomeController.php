<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Solutions\Appointments\Models\TimeSlot;
use Solutions\Blog\Models\Post;
use Solutions\Faqs\Models\Faq;
use Solutions\Language\Models\Language;
use Solutions\Founder\Models\Founder;
use Solutions\MainSlider\Models\MainSlider;
use Solutions\Media\Models\Photo;
use Solutions\Media\Models\Video;
use Solutions\Services\Models\Service;
use Solutions\Statistics\Models\Statistics;
use Solutions\Testimonial\Models\Testimonial;
use Solutions\Transformation\Models\Transformation;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        $langs = Language::where('status', 1)
            ->orderBy('order')
            ->get(['code', 'name', 'dir', 'is_default']);

        $activeLocale = session(
            'front_locale',
            optional($langs->firstWhere('is_default', 1))->code ?? app()->getLocale()
        );

        $mainSlider = MainSlider::where('status', true)
            ->orderBy('order')
            ->get();

        $founder = Founder::get();

        $statistics = Statistics::where('status', 1)
            ->orderBy('order')
            ->get();

        $testimonials = Testimonial::where('status', true)
            ->orderBy('order')
            ->get();

        $services = Service::where('status', true)
            ->orderBy('order')
            ->get();

        $blogs = Post::where('status', true)
            ->where('category_id', 1)
            ->orderBy('id', 'desc')
            ->take(3)
            ->get();

        $faqs = Faq::where('status', true)
            ->orderBy('order')
            ->orderBy('id', 'desc')
            ->get();

        $time_slots = TimeSlot::where('is_active', 1)
            ->orderBy('start_time')
            ->orderBy('weekday')
            ->get();

        $videos = Video::where('status', true)
            ->orderBy('order')
            ->orderByDesc('id')
            ->take(3)
            ->get();

        $photos = Photo::where('status', true)
            ->orderBy('order')
            ->orderByDesc('id')
            ->take(4)
            ->get();

        // ✅ Add Transformation data here
        $transformations = Transformation::orderBy('id', 'desc')
            ->take(2)
            ->get();

        // dd($transformations);
        return view('front.home.index', compact(
            'langs',
            'activeLocale',
            'mainSlider',
            'founder',
            'statistics',
            'testimonials',
            'services',
            'videos',
            'photos',
            'time_slots',
            'blogs',
            'faqs',
            'transformations'
        ));
    }
}
