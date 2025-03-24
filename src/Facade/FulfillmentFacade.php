<?php

namespace Exewen\Cdiscount\Facade;

use Exewen\Cdiscount\Contract\FulfillmentInterface;
use Exewen\Facades\AppFacade;
use Exewen\Facades\Facade;
use Exewen\Http\HttpProvider;
use Exewen\Logger\LoggerProvider;


/**
 * @method static array setProducts(array $params, array $header = [])
 * @method static array setInboundShipments(array $params, array $header = [])
 * @method static array setOutboundShipments(array $params, array $header = [])
 * @method static array getOutboundShipments(string $outboundShipmentId, array $params, array $header = [])
 * @method static array cancelOutboundShipments(array $params, array $header = [])
 */
class FulfillmentFacade extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return FulfillmentInterface::class;
    }

    public static function getProviders(): array
    {
        AppFacade::getContainer()->singleton(FulfillmentInterface::class);

        return [
            LoggerProvider::class,
            HttpProvider::class
        ];
    }
}