<?php


namespace App\Shipping\CountryCalculators;


use App\Contracts\IPrice;
use App\Shipping\Price\PriceUs;

class CalcWorld implements \App\Contracts\ICountryShippingCalc
{

    public function calculate($order): IPrice
    {
        return new PriceUs(200);
    }
}