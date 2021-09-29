<?php


namespace App\Shipping\Countries\Uk\BoxPricing;

use App\Shipping\CommonCalculations\BoxPricing\PremiumBox;

class UefaChampionBox extends PremiumBox
{
    protected function getCurrentType()
    {
        return "UEFA_CHAMPION";
    }

    protected function getCountryPrice()
    {
        return 40;
    }
}