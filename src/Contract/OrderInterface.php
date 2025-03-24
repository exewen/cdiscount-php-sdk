<?php
declare(strict_types=1);

namespace Exewen\Cdiscount\Contract;


interface OrderInterface
{
    public function getOrders(array $params, array $header = []);

    public function setShipments(string $orderId, array $params, array $header = []);

}