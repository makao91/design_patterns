<?php declare(strict_types=1);

namespace App\Payments;

class Przelewy24 implements IPayment
{
    public function pay()
    {
        return 'Payed by PRZELEWY_24';
    }
}