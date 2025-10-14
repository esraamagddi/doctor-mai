
<?php

return [
    [
        'title' => __('acl::messages.roles'),
        'icon'  => 'fa fa-shield',
        'route' => 'roles.index',
        'group'      => 'core',
        'order'      => 3,
        'children' => [
            ['title' => __('acl::messages.roles'), 'route' => 'roles.index'],
            ['title' => __('acl::messages.add_role'), 'route' => 'roles.create'],
        ],
    ],
];
