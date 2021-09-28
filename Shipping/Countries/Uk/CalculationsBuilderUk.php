<?php
namespace App\Shipping\Countries\Uk;

use App\Contracts\ICountryShippingCalc;
use App\Contracts\IPrice;
use App\Shipping\Countries\CalculationsBuilder;
use App\Shipping\Countries\Uk\BoxPricing\PremiumBoxUk;

class CalculationsBuilderUk extends CalculationsBuilder
{
    public function useOrderTotal():IPrice
    {
        return (new OrderTotalUk())->calculate($this->order);
    }

    public function useBoxPricing(IPrice $price):IPrice
    {
        return (new PremiumBoxUk($price))->calculate($this->order);
    }
}