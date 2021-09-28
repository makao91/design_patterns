<?php
namespace App\Shipping\Countries\Pl;

use App\Contracts\ICountryShippingCalc;
use App\Shipping\Countries\CalculationsBuilder;
use App\Shipping\Countries\Pl\BoxPricing\PremiumBoxPl;

class CalculationsBuilderPl extends CalculationsBuilder
{
    public function useOrderTotal():ICountryShippingCalc
    {
        return new OrderTotalPl();
    }

    public function useBoxPricing(ICountryShippingCalc $calculations_component)
    {
        return new PremiumBoxPl($calculations_component);
    }
}