<?php
namespace App\Shipping\Price;

use App\Contracts\IPrice;
use App\Shipping\Countries\Pl\PricePl;

class PriceFactory
{
    public function create($country_code, float $value):IPrice
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