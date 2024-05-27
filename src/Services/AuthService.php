<?php

namespace Exewen\Cdiscount\Services;

use Exewen\Config\Contract\ConfigInterface;
use Exewen\Di\Container;
use Exewen\Http\Contract\HttpClientInterface;
use Exewen\Logger\Contract\LoggerInterface;

class AuthService
{
    private $httpClient;
    private $driver;
    private $authUrl = '/auth/realms/maas/protocol/openid-connect/token';

    public function __construct(ConfigInterface $config)
    {
        $this->httpClient = Container::getInstance()->get(HttpClientInterface::class);
        $this->driver = $config->get('cdiscount.channel_auth');
    }

    public function getAuth(string $clientId, string $clientSecret)
    {
        return $this->httpClient->post($this->driver, $this->authUrl, [
            'grant_type' => 'client_credentials',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
        ]);
    }


}