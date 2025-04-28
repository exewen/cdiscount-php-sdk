<?php

namespace Exewen\Cdiscount\Services;

use Exewen\Cdiscount\Contract\OrderInterface;
use Exewen\Config\Contract\ConfigInterface;
use Exewen\Http\Contract\HttpClientInterface;

class OrdersService implements OrderInterface
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


    public function getOrders(array $params, array $header = [])
    {
        $response = $this->httpClient->get($this->driver, $this->ordersUrl, $params, $header);
        $result   = $response->getBody()->getContents();
        return json_decode($result, true);
    }

    public function setShipments(string $orderId, array $params, array $header = [])
    {
        $url      = str_replace('{orderId}', $orderId, $this->setShipmentsUrl);
        $response = $this->httpClient->post($this->driver, $url, $params, $header, [], 'json');
        $result   = $response->getBody()->getContents();
        return json_decode($result, true);
    }


}