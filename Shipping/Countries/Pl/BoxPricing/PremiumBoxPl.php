<?php


namespace App\Shipping\Countries\Pl\BoxPricing;

use App\Shipping\CommonCalculations\BoxPricing\PremiumBox;

class PremiumBoxPl extends PremiumBox
{
    protected function getCurrentType()
    {
        return "PREMIUM_BOX";
    }

    protected function getCountryPrice()
    {
        return 40;
    }
}