<?php declare(strict_types=1);

namespace App\Payments;

class ApplePay implements IPayment
{
    public function pay()
    {
        return 'Payed by APPLE_PAY';
    }
}