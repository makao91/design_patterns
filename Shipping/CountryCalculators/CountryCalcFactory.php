<?php


namespace App\Shipping\CountryCalculators;

use App\Contracts\ICountryShippingCalc;
use App\Contracts\IShippingOrder;

class CountryCalcFactory
{
    public function create(IShippingOrder $order): ICountryShippingCalc
    {
        $country_code = $order->getCountry();
        switch ($country_code)
        {
            case "PL":
                return new CalcPl();
            case "UK":
                return new CalcUk();
            case "US":
                return new CalcUs();
            default:
                return new CalcWorld();
        }
    }
}