<?php
declare(strict_types=1);

namespace ExewenTest\Cdiscount;

use Exewen\Cdiscount\Contract\CdiscountInterface;
use Exewen\Di\Container;
use Exewen\Http\HttpProvider;
use Exewen\Logger\LoggerProvider;
use Exewen\Cdiscount\CdiscountProvider;
use PHPUnit\Framework\TestCase;

class Base extends TestCase
{
    protected $app;

    protected $cdiscount;

    protected $sellerId;

    protected $accessToken;

    public function __construct()
    {
        parent::__construct();
        !defined('BASE_PATH_PKG') && define('BASE_PATH_PKG', dirname(__DIR__, 1));

        $app = new Container();
        $app->setProviders([
            LoggerProvider::class,
            HttpProvider::class,
            CdiscountProvider::class,
        ]);
        $this->app = $app;

        /** @var CdiscountInterface $cdiscount */
        $cdiscount = $this->app->get(CdiscountInterface::class);
        $this->cdiscount = $cdiscount;


        $this->sellerId = getenv('CD_SELLER_ID');
        $this->accessToken = getenv('CD_ACCESS_TOKEN');

        $this->cdiscount->setAccessToken($this->accessToken);
        $this->cdiscount->setSellerId($this->sellerId);
    }

}