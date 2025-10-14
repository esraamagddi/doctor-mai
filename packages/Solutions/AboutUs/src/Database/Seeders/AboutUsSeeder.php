<?php

namespace Solutions\AboutUs\Database\Seeders;

use Illuminate\Database\Seeder;
use Solutions\AboutUs\Models\AboutUs;

class AboutUsSeeder extends Seeder
{
    public function run()
    {
        AboutUs::create([
            'title' => [
                'en' => 'About Our Company',
                'ar' => 'عن شركتنا'
            ],
            'sub_title' => [
                'en' => 'Who We Are',
                'ar' => 'من نحن'
            ],
            'mission' => [
                'en' => 'Our mission is to provide quality services.',
                'ar' => 'مهمتنا تقديم خدمات عالية الجودة.'
            ],
            'vision' => [
                'en' => 'Our vision is to be a market leader.',
                'ar' => 'رؤيتنا أن نكون رواد السوق.'
            ],
            'values' => [
                'en' => 'Integrity, Innovation, Excellence',
                'ar' => 'النزاهة، الابتكار، التميز'
            ],
            'goals' => [
                'en' => 'Expand globally',
                'ar' => 'التوسع عالمياً'
            ],
            'history' => [
                'en' => 'Founded in 2010',
                'ar' => 'تأسست عام 2010'
            ],
            'image' => 'aboutus/default.jpg',
            'video_url' => 'https://youtube.com/example',
            'contact_email' => 'info@example.com',
            'contact_phone' => '+201000000000',
            'facebook' => 'https://facebook.com/example',
            'twitter' => 'https://twitter.com/example',
            'linkedin' => 'https://linkedin.com/in/example',
            'instagram' => 'https://instagram.com/example',
            'youtube' => 'https://youtube.com/example'
        ]);
    }
}
