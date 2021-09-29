<?php
namespace App\Shipping\Countries\Pl;

use App\Contracts\ICountryShippingCalc;
use App\Shipping\Countries\CalculationsBuilder;
use App\Shipping\Countries\Pl\BoxPricing\PremiumBoxPl;


class CalculationsBuilderPl extends CalculationsBuilder
{
    public function useBoxPricing(ICountryShippingCalc $calculations_component):ICountryShippingCalc
    {
        $box_price_decorator = new PremiumBoxPl($calculations_component);

        return $box_price_decorator;
    }
}