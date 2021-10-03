<?php declare(strict_types=1);

namespace App\Payments;

class Paypal implements IPayment
{
    public function aha()
    {
        return 'Payed by PAYPAL';
    }
}