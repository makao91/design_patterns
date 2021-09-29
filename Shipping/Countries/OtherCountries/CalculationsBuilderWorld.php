<?php
namespace App\Shipping\Countries\OtherCountries;

use App\Contracts\ICountryShippingCalc;
use App\Shipping\Countries\CalculationsBuilder;
use App\Shipping\Countries\OtherCountries\BoxPricing\PremiumBoxWorld;

class CalculationsBuilderWorld extends CalculationsBuilder
{
    public function useBoxPricing(ICountryShippingCalc $calculations_component):ICountryShippingCalc
    {
        $box_price_decorator = new PremiumBoxWorld($calculations_component);

        return $box_price_decorator;
    }
}