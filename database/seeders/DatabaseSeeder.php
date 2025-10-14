<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Solutions\AboutUs\Database\Seeders\AboutUsSeeder;
use Solutions\Blog\Database\Seeders\CategorySeeder;
use Solutions\Blog\Database\Seeders\PostSeeder;
use Solutions\Faqs\Database\Seeders\FaqsSeeder;
use Solutions\Founder\Database\Seeders\FounderSeeder;
use Solutions\MainSlider\Database\Seeders\MainSliderSeeder;
use Solutions\Services\Database\Seeders\ServiceSeeder;
use Solutions\Statistics\Database\Seeders\StatisticsSeeder;
use Solutions\Team\Database\Seeders\TeamSeeder;
use Solutions\Testimonial\Database\Seeders\TestimonialSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
$this->call([
    UserSeeder::class
    // AboutUsSeeder::class,
    // CategorySeeder::class,
    // PostSeeder::class,
    // // FaqsSeeder::class,
    // FounderSeeder::class,
    // MainSliderSeeder::class,
    // ServiceSeeder::class,
    // StatisticsSeeder::class,
    // TeamSeeder::class,
    // TestimonialSeeder::class,

]);

    }
}
