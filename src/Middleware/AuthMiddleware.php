<?php

namespace Exewen\Cdiscount\Middleware;

use Exewen\Config\Contract\ConfigInterface;
use Exewen\Facades\AppFacade;
use Psr\Http\Message\RequestInterface;

class AuthMiddleware
{
//    private string $config;

    private $appConfig;
    private $config;
    private $channel;

    public function __construct(string $channel, array $config)
    {
        $this->appConfig = AppFacade::getContainer()->get(ConfigInterface::class);
        $this->channel = $channel;
        $this->config = $config;
    }

    public function __invoke(callable $handler): callable
    {
        return function (RequestInterface $request, array $options) use ($handler) {
            $this->config = $this->appConfig->get("http.channels.{$this->channel}"); // 刷新单例到最新配置

            $accessToken = $this->config['extra']['access_token'] ?? '';
            $sellerId = $this->config['extra']['seller_id'] ?? '';
            $modifiedRequest = $request
                ->withHeader('Authorization', 'Bearer ' . $accessToken)
                ->withHeader('SellerId', $sellerId);
            return $handler($modifiedRequest, $options);
        };
    }


}