<?php
namespace App\Shipping\Countries\OtherCountries;

use App\Contracts\ICountryShippingCalc;
use App\Contracts\IPrice;
use App\Shipping\Countries\CalculationsBuilder;
use App\Shipping\Countries\OtherCountries\BoxPricing\PremiumBoxWorld;


class CalculationsBuilderWorld extends CalculationsBuilder
{
    public function useOrderTotal():IPrice
    {
        return (new OrderTotalWorld())->calculate($this->order);
    }

    public function useBoxPricing(IPrice $price):IPrice
    {
        return (new PremiumBoxWorld($price))->calculate($this->order);
    }
}