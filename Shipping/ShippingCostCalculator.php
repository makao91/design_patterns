<?php
namespace App\Shipping;

use App\Contracts\ICountryShippingCalc;
use App\Contracts\IPrice;
use App\Contracts\IShippingOrder;

class ShippingCostCalculator
{
    public function calculate(IShippingOrder $order):IPrice
    {
        $calc_factory = new CountryCalcFactory();
        $country_calculations_builder = $calc_factory->create($order);
        $calculations_director = new CalculationsDirector($country_calculations_builder);

        return $calculations_director->calculate();
    }
}