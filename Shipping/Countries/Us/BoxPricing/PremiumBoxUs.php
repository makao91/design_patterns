<?php


namespace App\Shipping\Countries\Us\BoxPricing;

use App\Shipping\CommonCalculations\BoxPricing\PremiumBox;

class PremiumBoxUs extends PremiumBox
{
    protected function getCurrentType()
    {
        return "PREMIUM_BOX";
    }

    protected function getCountryPrice()
    {
        return 17;
    }
}