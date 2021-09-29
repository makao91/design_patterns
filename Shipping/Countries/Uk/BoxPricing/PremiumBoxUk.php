<?php


namespace App\Shipping\Countries\Uk\BoxPricing;

use App\Shipping\CommonCalculations\BoxPricing\PremiumBox;

class PremiumBoxUk extends PremiumBox
{
    protected function getCurrentType()
    {
        return "PREMIUM_BOX";
    }

    protected function getCountryPrice()
    {
        return 20;
    }
}