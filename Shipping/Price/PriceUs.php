<?php
namespace App\Shipping\Price;

use App\Contracts\IPrice;

class PriceUs implements IPrice
{
    private $value = 0;
    private $currency_code = '$';

    public function __construct(float $value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getCurrencyCode()
    {
        return $this->currency_code;
    }

    public function getFomatedValue()
    {
        return $this->currency_code.$this->value;
    }
}