<?php

declare(strict_types=1);

use Exewen\Http\Middleware\HeaderNacosMiddleware;
use Exewen\Http\Middleware\LogMiddleware;

return [
    'channels' => [
        'cdiscount' => [
            'ssl' => false,
            'host' => 'https://auth.octopia-io.net',
            'port' => '443',
            'prefix' => null,
            'connect_timeout' => 3,
            'timeout' => 3,
            'handler' => [
//                HeaderNacosMiddleware::class,
//                LogMiddleware::class,
            ],
            'extra' => [
                'header' => [
                    'identity_key' => 'xxx',
                    'identity_value' => 'xxx',
                ],
            ]
        ],
    ]

];