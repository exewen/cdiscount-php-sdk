<?php

namespace Exewen\Cdiscount\Facade;

use Exewen\Cdiscount\Contract\FinanceInterface;
use Exewen\Facades\AppFacade;
use Exewen\Facades\Facade;
use Exewen\Http\HttpProvider;
use Exewen\Logger\LoggerProvider;

/**
 * @method static array getPayments(array $params, array $header = [])
 */
class FinanceFacade extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return FinanceInterface::class;
    }

    public static function getProviders(): array
    {
        AppFacade::getContainer()->singleton(FinanceInterface::class);

        return [
            LoggerProvider::class,
            HttpProvider::class
        ];
    }
}