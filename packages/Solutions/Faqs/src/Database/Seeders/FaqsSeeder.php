<?php 
namespace Solutions\Faqs\Database\Seeders;

use Illuminate\Database\Seeder;
use Solutions\Faqs\Models\FaqCategory;
use Solutions\Faqs\Models\Faq;

class FaqsSeeder extends Seeder
{
    public function run()
    {
        $cat = FaqCategory::create([
            'title' => ['en' => 'General', 'ar' => 'عام'],
            'slug' => 'general',
            'order' => 0,
            'status' => 1,
        ]);

        Faq::create([
            'question' => ['en' => 'What is your service?', 'ar' => 'ما هي خدمتكم؟'],
            'answer'   => ['en' => 'We provide X.', 'ar' => 'نحن نقدم X.'],
            'category_id' => $cat->id,
            'order' => 0,
            'status' => 1,
        ]);
    }
}
