<?php
namespace App\Shipping\Countries\Us;

use App\Contracts\ICountryShippingCalc;
use App\Contracts\IPrice;
use App\Shipping\Countries\CalculationsBuilder;
use App\Shipping\Countries\Us\BoxPricing\PremiumBoxUs;

class CalculationsBuilderUs extends CalculationsBuilder
{
    public function useOrderTotal():IPrice
    {
        return (new OrderTotalUs())->calculate($this->order);
    }

    public function useBoxPricing(IPrice $price):IPrice
    {
        return (new PremiumBoxUs($price))->calculate($this->order);
    }
}