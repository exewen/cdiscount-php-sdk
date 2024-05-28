<?php

declare(strict_types=1);

namespace Exewen\Cdiscount;

use Exewen\Cdiscount\Contract\CdiscountInterface;
use Exewen\Cdiscount\Middleware\AuthMiddleware;
use Exewen\Http\Middleware\LogMiddleware;

class ConfigRegister
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                CdiscountInterface::class => Cdiscount::class,
            ],

            'cdiscount' => [
                'channel_auth' => 'cdiscount_auth',
                'channel_api'  => 'cdiscount_api',
            ],

            'http' => [
                'channels' => [
                    'cdiscount_auth' => [
                        'verify'          => false,
                        'ssl'             => true,
                        'host'            => 'auth.octopia.com',
                        'port'            => null,
                        'prefix'          => null,
                        'connect_timeout' => 3,
                        'timeout'         => 10,
                        'handler'         => [
//                            LogMiddleware::class,
                        ]
                    ],
                    'cdiscount_api'  => [
                        'verify'          => false,
                        'ssl'             => true,
                        'host'            => 'api.octopia-io.net',
                        'port'            => null,
                        'prefix'          => null,
                        'connect_timeout' => 3,
                        'timeout'         => 20,
                        'handler'         => [
                            AuthMiddleware::class,
//                            LogMiddleware::class,
                        ],
                        'extra'           => [
                            'access_token' => null,
                            'seller_id'    => null
                        ],
                        'proxy'           => [
                            'switch' => false,
                            'http'   => '127.0.0.1:8888',
                            'https'  => '127.0.0.1:8888'
                        ]
                    ],
                ]
            ]

        ];
    }
}
