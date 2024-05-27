<?php
declare(strict_types=1);

namespace Exewen\Cdiscount;

use Exewen\Di\ServiceProvider;
use Exewen\Cdiscount\Contract\CdiscountInterface;

class CdiscountProvider extends ServiceProvider
{

    /**
     * 服务注册
     * @return void
     */
    public function register()
    {
        $this->container->singleton(CdiscountInterface::class);
    }

}