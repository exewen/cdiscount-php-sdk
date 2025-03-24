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
        $result = $this->httpClient->post($this->driver, '/fulfillment-products', $params, $header);
        return json_decode($result, true);
    }

    public function setInboundShipments(array $params, array $header = [])
    {
        $result = $this->httpClient->post($this->driver, '/inbound-shipments', $params, $header);
        return json_decode($result, true);
    }

    public function setOutboundShipments(array $params, array $header = [])
    {
        $result = $this->httpClient->post($this->driver, '/outbound-shipments', $params, $header);
        return json_decode($result, true);
    }

    public function getOutboundShipments(string $outboundShipmentId, array $params, array $header = [])
    {
        $url    = str_replace('{orderId}', $outboundShipmentId, '/outbound-shipments');
        $result = $this->httpClient->get($this->driver, $url, $params, $header);
        return json_decode($result, true);
    }

    public function cancelOutboundShipments(array $params, array $header = [])
    {
        $result = $this->httpClient->post($this->driver, '/outbound-cancellation-requests', $params, $header);
        return json_decode($result, true);
    }

}