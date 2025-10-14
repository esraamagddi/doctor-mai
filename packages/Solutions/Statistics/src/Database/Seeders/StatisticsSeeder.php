<?php 
namespace Solutions\Statistics\Database\Seeders;

use Illuminate\Database\Seeder;
use Solutions\Statistics\Models\Statistics;

class StatisticsSeeder extends Seeder
{
    public function run()
    {
        $stat = Statistics::create([
            'title' => [
                'en' => 'Company Statistics',
                'ar' => 'إحصائيات الشركة'
            ],
            'short_description' => [
                'en' => 'Some brief info about our statistics',
                'ar' => 'معلومات موجزة عن إحصائياتنا'
            ],
            'description' => [
                'en' => 'Detailed statistics about our performance.',
                'ar' => 'إحصائيات مفصلة عن أدائنا.'
            ],
            'image' => 'statistics/default.jpg',
            'order' => 1,
            'status' => 1
        ]);

        $stat->details()->createMany([
            [
                'number' => 120,
                'short_description' => ['en' => 'Projects', 'ar' => 'مشاريع'],
                'description' => ['en' => 'Completed projects', 'ar' => 'المشاريع المنجزة'],
                'icon' => 'fa fa-briefcase'
            ],
            [
                'number' => 300,
                'short_description' => ['en' => 'Clients', 'ar' => 'عملاء'],
                'description' => ['en' => 'Satisfied clients', 'ar' => 'عملاء سعداء'],
                'icon' => 'fa fa-users'
            ],
        ]);
    }
}
