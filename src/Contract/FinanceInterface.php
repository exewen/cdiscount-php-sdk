<?php
declare(strict_types=1);

namespace Exewen\Cdiscount\Contract;


interface FinanceInterface
{
    public function getPayments(array $params, array $header = []);

}