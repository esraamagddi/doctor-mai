<?php

return [
    [
        'title'    => __('aboutus::messages.about_us'),
        'icon'     => 'fa fa-info-circle',
        'route'    => 'aboutus.index',
        'group'      => 'website',
        'order'      => 1,
        'children' => [
            [
                'title' => __('aboutus::messages.about_us'),
                'route' => 'aboutus.index',
            ],
            [
                'title' => __('founder::messages.founder'),
                'route' => 'founder.index', // جاي من الباكدج التاني
            ],
        ],
    ],
];
