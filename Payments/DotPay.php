<?php declare(strict_types=1);

namespace App\Payments;

class DotPay implements IPayment
{
    public function pay()
    {
        return 'Payed by DOT_PAY';
    }
}