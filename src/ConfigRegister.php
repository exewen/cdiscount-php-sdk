<?php

declare(strict_types=1);

namespace Exewen\Cdiscount;

use Exewen\Cdiscount\Contract\AuthInterface;
use Exewen\Cdiscount\Contract\FinanceInterface;
use Exewen\Cdiscount\Contract\FulfillmentInterface;
use Exewen\Cdiscount\Contract\OrderInterface;
use Exewen\Cdiscount\Middleware\AuthMiddleware;
use Exewen\Cdiscount\Services\AuthService;
use Exewen\Cdiscount\Services\FinanceService;
use Exewen\Cdiscount\Services\FulfillmentService;
use Exewen\Cdiscount\Services\OrdersService;

class ConfigRegister
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                AuthInterface::class        => AuthService::class,
                FinanceInterface::class     => FinanceService::class,
                FulfillmentInterface::class => FulfillmentService::class,
                OrderInterface::class       => OrdersService::class,
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
