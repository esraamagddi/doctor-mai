<?php 
namespace Solutions\Team\Database\Seeders;

use Illuminate\Database\Seeder;
use Solutions\Team\Models\Team;

class TeamSeeder extends Seeder
{
    public function run()
    {
        Team::create([
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
            'image' => 'team/mohamed.jpg',
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
