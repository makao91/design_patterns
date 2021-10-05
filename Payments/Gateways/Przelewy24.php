<?php declare(strict_types=1);

namespace App\Payments\Gateways;

use App\Payments\Contracts\IPayment;
use App\Payments\PaymentService;

class Przelewy24 extends PaymentService implements IPayment
{
    public function useExclusiveGatewayLogic($total_price)
    {
        return 'Payed by Przelewy24: '.$total_price;
    }
}