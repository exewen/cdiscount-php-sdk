<?php

namespace Exewen\Cdiscount\Facade;

use Exewen\Cdiscount\Contract\AuthInterface;
use Exewen\Facades\AppFacade;
use Exewen\Facades\Facade;
use Exewen\Http\HttpProvider;
use Exewen\Logger\LoggerProvider;

/**
 * @method static void setAccessToken(string $accessToken, string $channel = 'cdiscount_api')
 * @method static void setSellerId(string $sellerId, string $channel = 'cdiscount_api')
 * @method static array getAccessToken(string $clientId, string $clientSecret)
 */
class AuthFacade extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return AuthInterface::class;
    }

    public static function getProviders(): array
    {
        AppFacade::getContainer()->singleton(AuthInterface::class);

        return [
            LoggerProvider::class,
            HttpProvider::class
        ];
    }
}