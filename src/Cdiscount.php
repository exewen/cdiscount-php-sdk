<?php

declare(strict_types=1);

namespace Exewen\Cdiscount;

use Exewen\Cdiscount\Contract\CdiscountInterface;
use Exewen\Cdiscount\Exception\CdiscountException;
use Exewen\Cdiscount\Services\AuthService;
use Exewen\Cdiscount\Services\OrdersService;
use Exewen\Cdiscount\Services\FinanceService;
use Exewen\Config\Contract\ConfigInterface;

class Cdiscount implements CdiscountInterface
{
    private $config;
    private $authService;
    private $ordersService;
    private $financeService;

    public function __construct(
        ConfigInterface $config,
        AuthService     $authService,
        OrdersService   $ordersService,
        FinanceService  $financeService
    )
    {
        $this->config = $config;
        $this->authService = $authService;
        $this->ordersService = $ordersService;
        $this->financeService = $financeService;
    }

    public function getAccessToken(string $clientId, string $clientSecret)
    {
        $result = json_decode($this->authService->getAuth($clientId, $clientSecret), true);
        if (!isset($result['access_token'])) {
            throw new CdiscountException('Cdiscount:获取token异常');
        }
        return $result;
    }

    public function setAccessToken(string $accessToken, string $channel = 'cdiscount_api')
    {
        $this->config->set('http.channels.' . $channel . '.extra.access_token', $accessToken);
    }

    public function setSellerId(string $sellerId, string $channel = 'cdiscount_api')
    {
        $this->config->set('http.channels.' . $channel . '.extra.seller_id', $sellerId);
    }


    public function getOrders(array $params, array $header = [])
    {
        return $this->ordersService->getOrders($params, $header);
    }

    public function getPayments(array $params, array $header = [])
    {
        return $this->financeService->getPayments($params, $header);

    }

    public function setShipments(string $orderId, array $params, array $header = [])
    {
        return $this->ordersService->setShipments($orderId, $params, $header);
    }


}
