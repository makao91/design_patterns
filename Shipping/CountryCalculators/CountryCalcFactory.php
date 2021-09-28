<?php


namespace App\Shipping\CountryCalculators;

use App\Contracts\ICountryShippingCalc;
use App\Contracts\IShippingOrder;

class CountryCalcFactory
{
    public function create($country_code): ICountryShippingCalc
    {
        switch ($country_code)
        {
            case "PL":
                return new OrderTotalPl();
            case "UK":
                return new OrderTotalUk();
            case "US":
                return new OrderTotalUs();
            default:
                return new OrderTotalWorld();
        }
    }
}