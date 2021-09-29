<?php
namespace App\Shipping\Countries\Us;

use App\Contracts\ICountryShippingCalc;
use App\Shipping\Countries\CalculationsBuilder;
use App\Shipping\Countries\Us\BoxPricing\PremiumBoxUs;


class CalculationsBuilderUs extends CalculationsBuilder
{

    public function useBoxPricing(ICountryShippingCalc $calculations_component):ICountryShippingCalc
    {
        $box_price_decorator = new PremiumBoxUs($calculations_component);

        return $box_price_decorator;
    }
}