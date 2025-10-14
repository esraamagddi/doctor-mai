<?php

namespace Solutions\MainSlider\Database\Seeders;

use Illuminate\Database\Seeder;
use Solutions\MainSlider\Models\MainSlider;

class MainSliderSeeder extends Seeder
{
    public function run()
    {
        MainSlider::create([
            'title' => [
                'en' => 'Welcome to Our Website',
                'ar' => 'مرحباً بكم في موقعنا'
            ],
            'subtitle' => [
                'en' => 'We deliver quality',
                'ar' => 'نحن نقدم الجودة'
            ],
            'description' => [
                'en' => 'Your success is our mission.',
                'ar' => 'نجاحك هو مهمتنا.'
            ],
            'image' => 'sliders/main_banner.jpg',
            // 'mobile_image' => 'sliders/main_banner_mobile.jpg',
            'video_url' => 'https://example.com/video.mp4',
            'link' => 'https://example.com',
            // 'button_text' => [
            //     'en' => 'Learn More',
            //     'ar' => 'اعرف المزيد'
            // ],
            // 'button_link' => 'https://example.com/about',
            // 'button_target' => '_blank',
            'overlay_color' => '#000000',
            'overlay_opacity' => 0.5,
            // 'extra_settings' => [
            //     'animation' => 'fade-in',
            //     'delay' => 300
            // ],
            'order' => 1,
            'status' => 1
        ]);
    }
}
