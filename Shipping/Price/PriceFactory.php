<?php
namespace App\Shipping\Price;

use App\Contracts\IPrice;
use App\Shipping\Countries\OtherCountries\PriceWorld;
use App\Shipping\Countries\Pl\PricePl;
use App\Shipping\Countries\Uk\PriceUk;
use App\Shipping\Countries\Us\PriceUs;

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
                return new PriceWorld($value);
        }
    }
}