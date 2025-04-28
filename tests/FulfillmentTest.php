<?php
declare(strict_types=1);

namespace ExewenTest\Cdiscount;

use Exewen\Cdiscount\Facade\FulfillmentFacade;

class FulfillmentTest extends Base
{

    /**
     * 测试订单信息
     * @return void
     */
    public function testFulfillmentList()
    {
        $params = [
            'state'              => 'Valid',
            'statusUpdatedAtMin' => '2025-03-22T19:35:35.384Z',
            'statusUpdatedAtMax' => '2025-05-01T19:35:35.384Z',
        ];
        $result = FulfillmentFacade::getOutboundShipmentsList($params);
        $this->assertNotEmpty($result);
    }


}