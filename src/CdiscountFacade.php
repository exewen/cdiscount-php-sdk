<?php
declare(strict_types=1);

namespace Exewen\Cdiscount;

use Exewen\Facades\Facade;
use Exewen\Cdiscount\Contract\CdiscountInterface;
use Exewen\Http\HttpProvider;
use Exewen\Logger\LoggerProvider;

/**
 * @method static void setAccessToken(string $accessToken, string $channel = 'cdiscount_api')
 * @method static void setSellerId(string $sellerId, string $channel = 'cdiscount_api')
 * @method static array getAccessToken(string $clientId, string $clientSecret)
 * @method static array getOrders(array $params, array $header = [])
 * @method static array getPayments(array $params, array $header = [])
 * @method static array setShipments(string $orderId, array $params, array $header = [])
 */
class CdiscountFacade extends Facade

{
    public static function getFacadeAccessor(): string
    {
        return CdiscountInterface::class;
    }

    public static function getProviders(): array
    {
        return [
            LoggerProvider::class,
            HttpProvider::class,
            CdiscountProvider::class
        ];
    }
}