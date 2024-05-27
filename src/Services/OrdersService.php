<?php

namespace Exewen\Cdiscount\Services;

use Exewen\Config\Contract\ConfigInterface;
use Exewen\Http\Contract\HttpClientInterface;

class OrdersService
{
    private $httpClient;
    private $driver;
    private $ordersUrl = '/seller/v2/orders';
    private $setShipmentsUrl = '/seller/v2/orders/{orderId}/shipments';

    public function __construct(HttpClientInterface $httpClient, ConfigInterface $config)
    {
        $this->httpClient = $httpClient;
        $this->driver     = $config->get('cdiscount.channel_api');
    }


    public function getOrders(array $params, array $header)
    {
        $result = $this->httpClient->get($this->driver, $this->ordersUrl, $params, $header);
        return json_decode($result, true);
    }

    public function setShipments(string $orderId, array $params, array $header)
    {
        $url    = $updatedEndpoint = str_replace('{orderId}', $orderId, $this->setShipmentsUrl);
        $result = $this->httpClient->get($this->driver, $url, $params, $header);
        return json_decode($result, true);
    }


}