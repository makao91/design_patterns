<?php declare(strict_types=1);

namespace App\Payments;

class CreditCard implements IPayment
{
    public function pay()
    {
        return 'Payed by CREDIT_CARD';
    }
}