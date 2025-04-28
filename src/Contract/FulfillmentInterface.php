<?php
declare(strict_types=1);

namespace Exewen\Cdiscount\Contract;


interface FulfillmentInterface
{

    public function setProducts(array $params, array $header = []);

    public function setInboundShipments(array $params, array $header = []);

    public function setOutboundShipments(array $params, array $header = []);

    public function getOutboundShipmentsList(array $params, array $header = []);

    public function getOutboundShipments(string $outboundShipmentId, array $params, array $header = []);

    public function cancelOutboundShipments(array $params, array $header = []);


}