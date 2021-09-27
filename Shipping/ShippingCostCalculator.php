<?php
namespace App\Shipping;

use App\Contracts\ICountryShippingCalc;
use App\Contracts\IPrice;
use App\Contracts\IShippingOrder;
use App\Contracts\IShippingClient;

use App\Orders\Order;
use App\Shipping\CountryCalculators\CountryCalcFactory;
use App\Shipping\Price\PricePl;
use App\Shipping\Price\PriceUk;
use App\Shipping\Price\PriceUs;

class ShippingCostCalculator
{
    public function calculate(ICountryShippingCalc $calc, IShippingClient $client):IPrice
    {
        //all future additional calculations related with shipping only should start/be added here
        $shipping_cost = $calc->calculate();

        //include client discount code

        //include additional money for premium type box

        //include discounts for special premium days of delivery

        return $shipping_cost;
    }
}