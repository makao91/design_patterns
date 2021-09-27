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
                return new CalcPl($order);
            case "UK":
                return new CalcUk($order);
            case "US":
                return new CalcUs($order);
            default:
                return new CalcWorld($order);
        }
    }
}