<?php
namespace App\Shipping\Price;

class PriceFactory
{
    public function create($country_code, float $value)
    {
        switch ($country_code)
        {
            case "PLN":
                return new PricePl($value);
            case "GBP":
                return new PriceUk($value);
            case "$":
                return new PriceUs($value);
            default:
                return new PriceUs($value);
        }
    }
}