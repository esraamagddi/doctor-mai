<?php

return [
    // Parent: Photos
    [
        'title' => __('media::messages.photos'),
        'icon'  => 'fa fa-image',
        'route' => 'media.photos.index',
        'group' => 'modules',
        'order' => 2,
        // مفيش children لو مش محتاجة
    ],

    // Parent: Videos
    [
        'title' => __('media::messages.videos'),
        'icon'  => 'fa fa-film', // أو fa fa-video-camera
        'route' => 'media.videos.index',
        'group' => 'modules',
        'order' => 3,
        'children' => [
            [
                'title'    => __('media::messages.videos'),
                'route'    => 'media.videos.index',
            ],
            [
                'title' => __('media::messages.video_categories'),
                'route' => 'media.video_categories.index',
            ],
        ],
    ],
];
