<?php declare(strict_types=1);

namespace App\Payments;

class GooglePay implements IPayment
{
    public function pay()
    {
        return 'Payed by GOOGLE_PAY';
    }
}