<?php

return [
    'groups' => [
        'core' => [
            'label' => 'أساسيات النظام',
            'order' => 1,
        ],
        'modules' => [
            'label' => 'موديولات العمل',
            'order' => 2,
        ],
        'website' => [
            'label' => 'محتوى الموقع',
            'order' => 3,
        ],
    ],
    // جروب افتراضي لو عنصر مفيهوش group
    'default_group' => 'core',
];
