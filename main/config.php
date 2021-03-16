<?php
return [
    'projectName' => 'Мой магазин',
    'defaultController' => 'good',
    'components' => [
        'db' => [
            'class' => \app\services\DB::class,
            'config' => [
                'driver' => 'mysql',
                'host' => 'localhost',
                'db' => 'gbphp',
                'charset' => 'UTF8',
                'login' => 'root',
                'password' => '',
            ]
        ],
        'renderer' => [
            'class' => \app\services\TwigRenderServices::class,
        ],
        'goodRepository' => [
            'class' => \app\repositories\GoodRepository::class,
        ],
        'basketService' => [
            'class' => \app\services\BasketService::class,
        ]
    ],
];