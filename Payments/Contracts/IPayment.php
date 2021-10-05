<?php declare(strict_types=1);

namespace App\Payments\Contracts;

interface IPayment
{
    public function useExclusiveGatewayLogic($total_price);
}