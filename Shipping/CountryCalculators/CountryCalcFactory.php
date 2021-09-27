<?php


namespace App\Shipping\CountryCalculators;

use App\Contracts\ICountryShippingCalc;

class CountryCalcFactory
{
    public function create($country_code): ICountryShippingCalc
    {
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