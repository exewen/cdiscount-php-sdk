<?php

namespace Exewen\Cdiscount\Middleware;

use Psr\Http\Message\RequestInterface;

class AuthMiddleware
{
//    private string $config;
    private $config;
    private $channel;

    public function __construct(string $channel, array $config)
    {
        $this->channel = $channel;
        $this->config = $config;
    }

    public function __invoke(callable $handler): callable
    {
        return function (RequestInterface $request, array $options) use ($handler) {
            $accessToken = $this->config['extra']['access_token'] ?? '';
            $sellerId = $this->config['extra']['seller_id'] ?? '';
            $modifiedRequest = $request
                ->withHeader('Authorization', 'Bearer ' . $accessToken)
                ->withHeader('SellerId', $sellerId);
            return $handler($modifiedRequest, $options);
        };
    }


}