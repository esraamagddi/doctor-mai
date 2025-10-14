<?php
namespace Solutions\Services\Database\Seeders;

use Illuminate\Database\Seeder;
use Solutions\Services\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        Service::create([
            'name' => [
                'en' => 'Web Design',
                'ar' => 'تصميم مواقع'
            ],
            'description' => [
                'en' => 'Professional web design services for businesses.',
                'ar' => 'خدمات تصميم مواقع احترافية للشركات.'
            ],
            'image' => 'services/web_design.jpg',
            'icon' => 'services/icons/web_icon.png',
            'pdf' => 'services/files/web_design.pdf',
            'link' => 'https://example.com/web-design',
            'features' => ['Responsive', 'SEO Friendly', 'Custom Design'],
            'social_links' => [
                'facebook' => 'https://facebook.com/webdesign',
                'twitter' => 'https://twitter.com/webdesign'
            ],
            'tags' => ['web','design','digital'],
            'order' => 1,
            'status' => 1
        ]);
    }
}
