<?php

namespace Exewen\Cdiscount\Services;

use Exewen\Cdiscount\Contract\FinanceInterface;
use Exewen\Config\Contract\ConfigInterface;
use Exewen\Http\Contract\HttpClientInterface;

class FinanceService implements FinanceInterface
{
    private $httpClient;
    private $driver;
    private $paymentsUrl = '/seller/v2/operations';

    public function __construct(HttpClientInterface $httpClient, ConfigInterface $config)
    {
        $this->httpClient = $httpClient;
        $this->driver = $config->get('cdiscount.channel_api');
    }


    public function getPayments(array $params, array $header = [])
    {
        $result = $this->httpClient->get($this->driver, $this->paymentsUrl, $params, $header);
        return json_decode($result, true);
    }


}