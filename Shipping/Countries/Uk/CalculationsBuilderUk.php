<?php
namespace App\Shipping\Countries\Uk;

use App\Contracts\ICountryShippingCalc;
use App\Shipping\Countries\CalculationsBuilder;
use App\Shipping\Countries\Uk\BoxPricing\PremiumBoxUk;

class CalculationsBuilderUk extends CalculationsBuilder
{
    public function useOrderTotal():ICountryShippingCalc
    {
        return new OrderTotalUk();
    }

    public function useBoxPricing(ICountryShippingCalc $calculations_component)
    {
        return new PremiumBoxUk($calculations_component);
    }
}