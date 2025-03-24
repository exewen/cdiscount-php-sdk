<?php
declare(strict_types=1);

namespace ExewenTest\Cdiscount;

use Exewen\Cdiscount\Facade\AuthFacade;
use Exewen\Cdiscount\Facade\FinanceFacade;
use Exewen\Cdiscount\Facade\OrderFacade;

class CdiscountTest extends Base
{
//    /**
//     * 获取token授权
//     * @return void
//     */
//    public function testGetAuth()
//    {
//        $clientId     = getenv('CD_CLIENT_ID');
//        $clientSecret = getenv('CD_CLIENT_SECRET');
//        $result       = AuthFacade::getAccessToken($clientId, $clientSecret);
//        echo $result['access_token'];
//        $this->assertNotEmpty($result);
//    }

    /**
     * 测试订单信息
     * @return void
     */
    public function testOrders()
    {
        $params = [
            'pageSize' => 1
        ];
        $result = OrderFacade::getOrders($params);
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

        $result = FinanceFacade::getPayments($params);
        var_dump($result);
        $this->assertNotEmpty($result);
    }

//    public function testSetShipments()
//    {
//        $orderId = '';
//        $params  = [
//            'pageSize' => 1
//        ];
//        $result  = OrderFacade::setShipments($orderId, $params);
//        var_dump($result);
//        $this->assertNotEmpty($result);
//    }


}