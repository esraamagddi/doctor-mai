<?php

return [
    [
        'title' => __('faqs::messages.faqs'),
        'icon' => 'fa fa-question-circle',
        'route' => 'faqs.index',
        'group' => 'modules',
        'order' => 2,
        'children' => [
            ['title' => __('faqs::messages.list'), 'route' => 'faqs.index'],
            ['title' => __('faqs::messages.categories'), 'route' => 'faqs.categories.index'],
        ],
    ],
];
