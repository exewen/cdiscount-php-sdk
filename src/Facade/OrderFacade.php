<?php

namespace Exewen\Cdiscount\Facade;

use Exewen\Cdiscount\Contract\OrderInterface;
use Exewen\Facades\AppFacade;
use Exewen\Facades\Facade;
use Exewen\Http\HttpProvider;
use Exewen\Logger\LoggerProvider;

/**
 * @method static array getOrders(array $params, array $header = [])
 * @method static array setShipments(string $orderId, array $params, array $header = [])
 */
class OrderFacade extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return OrderInterface::class;
    }

    public static function getProviders(): array
    {
        AppFacade::getContainer()->singleton(OrderInterface::class);

        return [
            LoggerProvider::class,
            HttpProvider::class
        ];
    }
}