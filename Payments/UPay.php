<?php declare(strict_types=1);

namespace App\Payments;

class UPay implements IPayment
{
    public function pay()
    {
        return 'Payed by UPAY';
    }
}