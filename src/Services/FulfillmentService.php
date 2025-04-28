<?php

namespace Exewen\Cdiscount\Services;

use Exewen\Cdiscount\Contract\FulfillmentInterface;
use Exewen\Config\Contract\ConfigInterface;
use Exewen\Http\Contract\HttpClientInterface;

class FulfillmentService implements FulfillmentInterface
{
    private $httpClient;
    private $driver;

    public function __construct(HttpClientInterface $httpClient, ConfigInterface $config)
    {
        $this->httpClient = $httpClient;
        $this->driver     = $config->get('cdiscount.channel_api');
    }

    public function setProducts(array $params, array $header = [])
    {
        $response = $this->httpClient->post($this->driver, '/seller/v2/fulfillment-products', $params, $header);
        $result   = $response->getBody()->getContents();
        return json_decode($result, true);
    }

    public function setInboundShipments(array $params, array $header = [])
    {
        $response = $this->httpClient->post($this->driver, '/seller/v2/inbound-shipments', $params, $header);
        $result   = $response->getBody()->getContents();
        return json_decode($result, true);
    }

    public function setOutboundShipments(array $params, array $header = [])
    {
        $response = $this->httpClient->post($this->driver, '/seller/v2/outbound-shipments', $params, $header);
        $result   = $response->getBody()->getContents();
        return json_decode($result, true);
    }

    public function getOutboundShipmentsList(array $params, array $header = [])
    {
        $response = $this->httpClient->get($this->driver, '/seller/v2/outbound-shipments', $params, $header);
        $result   = $response->getBody()->getContents();
        $result   = json_decode($result, true);
        $link     = $response->getHeaderLine('Link');
        return compact('result', 'link');
    }

    public function getOutboundShipments(string $outboundShipmentId, array $params, array $header = [])
    {
        $url      = str_replace('{orderId}', $outboundShipmentId, '/seller/v2/outbound-shipments/{orderId}');
        $response = $this->httpClient->get($this->driver, $url, $params, $header);
        $result   = $response->getBody()->getContents();
        return json_decode($result, true);
    }

    public function cancelOutboundShipments(array $params, array $header = [])
    {
        $response = $this->httpClient->post($this->driver, '/seller/v2/outbound-cancellation-requests', $params, $header);
        $result   = $response->getBody()->getContents();
        return json_decode($result, true);
    }

}