<?php 
namespace Solutions\Blog\Database\Seeders;

use Illuminate\Database\Seeder;
use Solutions\Blog\Models\Post;
use Solutions\Blog\Models\Category;

class PostSeeder extends Seeder
{
    public function run()
    {
        $cat = Category::first();
        Post::create([
            'title' => ['en' => 'Hello World', 'ar' => 'أهلاً بالعالم'],
            // 'slug' => 'hello-world',
            'content' => ['en' => 'First post content', 'ar' => 'محتوى أول مقالة'],
            'category_id' => optional($cat)->id,
            'status' => 1,
        ]);
    }
}