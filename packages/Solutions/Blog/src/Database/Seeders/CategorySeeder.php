<?php 
namespace Solutions\Blog\Database\Seeders;

use Illuminate\Database\Seeder;
use Solutions\Blog\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create([
            'name' => ['en' => 'General', 'ar' => 'عام'],
            // 'slug' => 'general',
            'status' => 1,
        ]);
    }
}