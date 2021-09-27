<?php
namespace App\Shipping;

use App\Contracts\ICountryShippingCalc;
use App\Contracts\IPrice;
use App\Orders\Order;
use App\Shipping\CountryCalculators\CountryCalcFactory;
use App\Shipping\Price\PricePl;
use App\Shipping\Price\PriceUk;
use App\Shipping\Price\PriceUs;

class ShippingCostCalculator
{
    public function calculate(ICountryShippingCalc $calc):IPrice
    {
        //all future additional calculations related with shipping only should start/be added here
        return $calc->calculate();
    }
}