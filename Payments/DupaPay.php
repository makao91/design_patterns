<?php declare(strict_types=1);

namespace App\Payments;

class DupaPay implements IPayment
{
    public function pay()
    {
        return 'Payed by DUPA_PAY';
    }
}