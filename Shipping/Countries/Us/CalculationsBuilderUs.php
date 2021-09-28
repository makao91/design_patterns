<?php
namespace App\Shipping\Countries\Us;

use App\Contracts\ICountryShippingCalc;
use App\Shipping\Countries\CalculationsBuilder;
use App\Shipping\Countries\Us\BoxPricing\PremiumBoxUs;

class CalculationsBuilderUs extends CalculationsBuilder
{
    public function useOrderTotal():ICountryShippingCalc
    {
        return new OrderTotalUs();
    }

    public function useBoxPricing(ICountryShippingCalc $calculations_component)
    {
        return new PremiumBoxUs($calculations_component);
    }
}