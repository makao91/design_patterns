<?php declare(strict_types=1);

namespace App\Payments;

class Blik implements IPayment
{
    public function pay()
    {
        return 'Payed by BLIK';
    }
}