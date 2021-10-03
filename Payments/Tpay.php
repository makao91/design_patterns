<?php declare(strict_types=1);

namespace App\Payments;

class Tpay implements IPayment
{
    public function pay()
    {
        return 'Payed by TPAY';
    }
}