<?php

namespace Exewen\Cdiscount\Services;

use Exewen\Cdiscount\Contract\AuthInterface;
use Exewen\Cdiscount\Exception\CdiscountException;
use Exewen\Config\Contract\ConfigInterface;
use Exewen\Http\Contract\HttpClientInterface;

class AuthService implements AuthInterface
{
    private $httpClient;
    private $driver;

    private $config;

    private $authUrl = '/auth/realms/maas/protocol/openid-connect/token';

    public function __construct(HttpClientInterface $httpClient, ConfigInterface $config)
    {
        $this->httpClient = $httpClient;
        $this->driver     = $config->get('cdiscount.channel_auth');
        $this->config     = $config;
    }

    public function getAuth(string $clientId, string $clientSecret)
    {
        return $this->httpClient->post($this->driver, $this->authUrl, [
            'grant_type'    => 'client_credentials',
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
        ], [], [], 'form_params');
    }


    public function getAccessToken(string $clientId, string $clientSecret)
    {
        $response = $this->getAuth($clientId, $clientSecret);
        $result = json_decode($response, true);
        if (!isset($result['access_token'])) {
            throw new CdiscountException("Cdiscount:获取token异常($response)");
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

}