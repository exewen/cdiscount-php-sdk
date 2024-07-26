<?php
declare(strict_types=1);

namespace ExewenTest\Cdiscount;

use Exewen\Cdiscount\CdiscountFacade;

class CdiscountTest extends Base
{
    /**
     * 获取token授权
     * @return void
     */
    public function testGetAuth()
    {
        $clientId     = getenv('CD_CLIENT_ID');
        $clientSecret = getenv('CD_CLIENT_SECRET');
        $result       = CdiscountFacade::getAccessToken($clientId, $clientSecret);
        echo $result['access_token'];
        $this->assertNotEmpty($result);
    }

    /**
     * 测试订单信息
     * @return void
     */
    public function testOrders()
    {
        $params = [
            'pageSize' => 1
        ];
        $result = CdiscountFacade::getOrders($params);
        var_dump($result);
        $this->assertNotEmpty($result);
    }

    /**
     * 测试结算信息
     * @return void
     */
    public function testPayments()
    {
        $params = [
            'pageSize' => 1
        ];

        $result = CdiscountFacade::getPayments($params);
        var_dump($result);
        $this->assertNotEmpty($result);
    }

    public function testSetShipments()
    {
        $orderId = '';
        $params  = [
            'pageSize' => 1
        ];
        $result  = CdiscountFacade::setShipments($orderId, $params);
        var_dump($result);
        $this->assertNotEmpty($result);
    }


}