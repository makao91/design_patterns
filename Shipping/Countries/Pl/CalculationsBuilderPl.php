<?php
namespace App\Shipping\Countries\Pl;

use App\Contracts\ICountryShippingCalc;
use App\Contracts\IPrice;
use App\Shipping\Countries\CalculationsBuilder;
use App\Shipping\Countries\Pl\BoxPricing\PremiumBoxPl;

class CalculationsBuilderPl extends CalculationsBuilder
{
    public function useOrderTotal():IPrice
    {
        return (new OrderTotalPl())->calculate($this->order);
    }

    public function useBoxPricing(IPrice $price):IPrice
    {
        return (new PremiumBoxPl($price))->calculate($this->order);
    }
}