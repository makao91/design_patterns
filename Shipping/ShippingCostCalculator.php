<?php
namespace App\Shipping;

use App\Contracts\IPrice;
use App\Orders\Order;
use App\Shipping\CountryCalculators\CountryCalcFactory;
use App\Shipping\Price\PricePl;
use App\Shipping\Price\PriceUk;
use App\Shipping\Price\PriceUs;

class ShippingCostCalculator
{
    public function calculate(Order $order):IPrice
    {
        $country = $order->getCountry();

        $country_calculator = (new CountryCalcFactory())->create($country);
        return $country_calculator->calculate($order);
    }
}