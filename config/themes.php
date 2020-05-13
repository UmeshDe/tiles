<?php

return [
    'default' => 'default',

    'themes' => [
        'default' => [
            'views_path' => 'resources/themes/default/views',
            'assets_path' => 'public/themes/default/assets',
            'name' => 'Default'
        ],

        // 'tiles' => [
        //     'views_path' => 'resources/themes/tiles/views',
        //     'assets_path' => 'public/themes/tiles/assets',
        //     'name' => 'Tiles',
        //     'parent' => 'default'
        // ],

        'velocity' => [
            'views_path' => 'resources/themes/velocity/views',
            'assets_path' => 'public/themes/velocity/assets',
            'name' => 'Velocity',
            'parent' => 'default'
        ],
    ]
];