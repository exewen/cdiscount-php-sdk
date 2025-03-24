<?php
declare(strict_types=1);

namespace Exewen\Cdiscount\Contract;


interface AuthInterface
{
    public function getAccessToken(string $clientId, string $clientSecret);

    public function setAccessToken(string $accessToken, string $channel = 'cdiscount_api');

    public function setSellerId(string $sellerId, string $channel = 'cdiscount_api');

}