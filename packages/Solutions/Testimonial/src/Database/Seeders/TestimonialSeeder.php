<?php 
namespace Solutions\Testimonial\Database\Seeders;

use Illuminate\Database\Seeder;
use Solutions\Testimonial\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run()
    {
        Testimonial::create([
            'name' => [
                'en' => 'Mohamed',
                'ar' => 'محمد'
            ],
            'job_title' => [
                'en' => 'Web Developer',
                'ar' => 'مطور ويب'
            ],
            'description' => [
                'en' => 'Experienced web developer specializing in Laravel.',
                'ar' => 'مطور ويب ذو خبرة متخصصة في لارافيل.'
            ],
            'image' => 'testimonial/mohamed.jpg',
            'email' => 'mohamed@example.com',
            'phone' => '+201000000000',
            'facebook' => 'https://facebook.com/mohamed',
            'twitter' => 'https://twitter.com/mohamed',
            'linkedin' => 'https://linkedin.com/in/mohamed',
            'instagram' => 'https://instagram.com/mohamed',
            'youtube' => 'https://youtube.com/mohamed',
            'order' => 1,
            'status' => 1
        ]);
    }
}
