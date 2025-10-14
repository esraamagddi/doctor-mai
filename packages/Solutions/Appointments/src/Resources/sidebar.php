<?php
return [
    [
        'title' => __('appointments::messages.title'),
        'icon' => 'fa fa-calendar',
        'route' => 'appointments.index',
        'group' => 'website',
        'order' => 4,
        'children' => [
            [
                'title' => __('appointments::messages.appointments'),
                'route' => 'appointments.index',
            ],

            [
                'title' => __('appointments::messages.patients'),
                'route' => 'patients.index',
            ],

            [
                'title' => __('appointments::messages.timeslots'),
                'route' => 'timeslots.index',
            ],
        ],
    ],
];
