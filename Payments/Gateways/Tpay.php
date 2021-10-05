<?php declare(strict_types=1);

namespace App\Payments\Gateways;

use App\Payments\Contracts\IPayment;
use App\Payments\PaymentService;

class Tpay extends PaymentService implements IPayment
{
    public function useExclusiveGatewayLogic($total_price)
    {
        return 'Payed by Tpay: '.$total_price;
    }
}