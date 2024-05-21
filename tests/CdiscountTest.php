<?php
declare(strict_types=1);

namespace ExewenTest\Cdiscount;

use Exewen\Di\Container;
use Exewen\Http\HttpProvider;
use Exewen\Logger\LoggerProvider;
use Exewen\Nacos\Contract\CdiscountInterface;
use Exewen\Nacos\NacosProvider;
use PHPUnit\Framework\TestCase;

class CdiscountTest extends TestCase
{
    private Container $app;
    private string $serviceName = 'pms-user';
    private string $dataId = 'pms-user.env';
    private string $group = 'DEFAULT_GROUP';
    private string $namespaceId = 'prd';

    public function __construct()
    {
        parent::__construct();
        !defined('BASE_PATH_PKG') && define('BASE_PATH_PKG', dirname(__DIR__, 1));
        \Exewen\Utils\FileUtil::setSnapshotPath(dirname(__DIR__) . "/config/nacos/env");

        $app = new Container();
        // 服务注册
        $app->setProviders([
            LoggerProvider::class,
            HttpProvider::class,
            NacosProvider::class,
        ]);
        $this->app = $app;
    }

    /**
     * 获取配置
     * @return void
     */
    public function testGetConfig()
    {
        /** @var CdiscountInterface $nacos */
        $nacos = $this->app->get(CdiscountInterface::class);
        $config = $nacos->getConfig($this->namespaceId, $this->dataId, $this->group);
        $this->assertNotEmpty($config);
    }

    /**
     * 拉取配置到本地
     * @return void
     */
    public function testSaveConfig()
    {
        /** @var CdiscountInterface $nacos */
        $nacos = $this->app->get(CdiscountInterface::class);
        $config = $nacos->saveConfig($this->namespaceId, $this->dataId, $this->group);
        $this->assertNotEmpty($config);
    }

    /**
     * 测试本地配置文件读取
     * @return void
     */
    public function testGetEnv()
    {
        $tempPath = \Exewen\Utils\FileUtil::getSnapshotFile($this->namespaceId, $this->dataId, $this->group);
        $envPath = substr($tempPath, strlen(BASE_PATH_PKG) + 1);
        !is_file($tempPath) && $envPath = '.env';
        $this->assertTrue($envPath !== '.env');
    }


    /**
     * 注册实例
     * @return void
     */
    public function testSetInstance()
    {
        /** @var CdiscountInterface $nacos */
        $nacos = $this->app->get(CdiscountInterface::class);
        $ip = '10.0.2.143';
        $port = 8081;
        $result = $nacos->setInstance($this->namespaceId, $this->serviceName, $this->group, $ip, $port);
        $this->assertTrue($result);
    }

    /**
     * 发送实例心跳
     * @return void
     */
    public function testSetInstanceBeat()
    {
        /** @var CdiscountInterface $nacos */
        $nacos = $this->app->get(CdiscountInterface::class);
        $ip = '10.0.2.143';
        $port = 8081;
        $result = $nacos->setInstanceBeat($this->namespaceId, $this->serviceName, $this->group, $ip, $port);
        $this->assertTrue($result);
    }

    /**
     * 获取实例列表
     * @return void
     */
    public function testGetInstance()
    {
        /** @var CdiscountInterface $nacos */
        $nacos = $this->app->get(CdiscountInterface::class);
        $result = $nacos->getInstance($this->namespaceId, $this->serviceName, $this->group, true);
        $this->assertNotEmpty($result['hosts'] ?? []);
    }

}