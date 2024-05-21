<?php

declare(strict_types=1);

namespace Exewen\Cdiscount;

use Exewen\Nacos\Contract\CdiscountInterface;

class ConfigRegister
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                CdiscountInterface::class => Cdiscount::class,
            ],

            'cdiscount' => [
                // 选择http模块驱动
                'http_channel' => 'nacos'
            ]


        ];
    }
}
