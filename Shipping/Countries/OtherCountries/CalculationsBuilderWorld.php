<?php
namespace App\Shipping\Countries\OtherCountries;

use App\Contracts\ICountryShippingCalc;
use App\Shipping\Countries\CalculationsBuilder;
use App\Shipping\Countries\OtherCountries\BoxPricing\PremiumBoxWorld;


class CalculationsBuilderWorld extends CalculationsBuilder
{
    public function useOrderTotal():ICountryShippingCalc
    {
        return new OrderTotalWorld();
    }

    public function useBoxPricing(ICountryShippingCalc $calculations_component)
    {
        return new PremiumBoxWorld($calculations_component);
    }
}