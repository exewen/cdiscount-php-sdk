<?php
declare(strict_types=1);

namespace Exewen\Cdiscount\Contract;


interface CdiscountInterface
{
    public function getAccessToken(string $clientId, string $clientSecret);

    public function setAccessToken(string $accessToken, string $channel = 'cdiscount_api');

    public function setSellerId(string $sellerId, string $channel = 'cdiscount_api');

    public function getOrders(array $params, array $header = []);

    public function getPayments(array $params, array $header = []);

    public function setShipments(string $orderId, array $params, array $header = []);

}