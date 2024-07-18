<?php

namespace Exewen\Cdiscount\Services;

use Exewen\Config\Contract\ConfigInterface;
use Exewen\Http\Contract\HttpClientInterface;

class AuthService
{
    private $httpClient;
    private $driver;
    private $authUrl = '/auth/realms/maas/protocol/openid-connect/token';

    public function __construct(HttpClientInterface $httpClient, ConfigInterface $config)
    {
        $this->httpClient = $httpClient;
        $this->driver     = $config->get('cdiscount.channel_auth');
    }

    public function getAuth(string $clientId, string $clientSecret)
    {
        return $this->httpClient->post($this->driver, $this->authUrl, [
            'grant_type'    => 'client_credentials',
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
        ], [], [], 'form_params');
    }


}