<?php

namespace Solutions\Founder\Database\Seeders;

use Illuminate\Database\Seeder;
use Solutions\Founder\Models\Founder;

class FounderSeeder extends Seeder
{
    public function run()
    {
        Founder::create([
            'name' => [
                'en' => 'John Doe',
                'ar' => 'جون دو'
            ],
            'position' => 'CEO & Founder',
            'short_desc' => 'Passionate entrepreneur',
            'speech' => 'I believe in innovation and leadership.',
            'image' => 'founder/default.jpg',
            'email' => 'founder@example.com',
            'phone' => '+201000000000',
            'facebook' => 'https://facebook.com/example',
            'twitter' => 'https://twitter.com/example',
            'linkedin' => 'https://linkedin.com/in/example',
            'instagram' => 'https://instagram.com/example',
            'youtube' => 'https://youtube.com/example'
        ]);
    }
}
