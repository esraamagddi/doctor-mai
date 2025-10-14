<?php

return [
    [
        'title' => __('blog::messages.blog'),
        'icon'  => 'fa fa-file-text-o',
        'route' => __('blog.posts.index'),
                'group'      => 'modules',
        'order'      => 1,
        'children' => [
            [
                'title' => __('blog::messages.blog_posts'),
                'route' => 'blog.posts.index',
            ],
     
            [
                'title' => __('blog::messages.category'),
                'route' => 'blog.categories.index',
            ],
         
        ],
    ],
];