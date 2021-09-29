<?php
namespace App\Shipping\Countries\Uk;

use App\Contracts\ICountryShippingCalc;
use App\Shipping\Countries\CalculationsBuilder;
use App\Shipping\Countries\Uk\BoxPricing\PremiumBoxUk;
use App\Shipping\Countries\Uk\BoxPricing\UefaChampionBox;


class CalculationsBuilderUk extends CalculationsBuilder
{
    public function useBoxPricing(ICountryShippingCalc $calculations_component):ICountryShippingCalc
    {
        $premium_box_decorator = new PremiumBoxUk($calculations_component);
        $uefa_champion_decorator = new UefaChampionBox($premium_box_decorator);

        return $uefa_champion_decorator;
    }
}