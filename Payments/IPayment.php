<?php declare(strict_types=1);

namespace App\Payments;

interface IPayment
{
    public function pay();
}