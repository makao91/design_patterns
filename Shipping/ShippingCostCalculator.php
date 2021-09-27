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
    public function calculate(Order $order):IPrice
    {
        $country = $order->getCountry();

        $country_calculator = (new CountryCalcFactory())->create($country);
        return $this->country_calc($country_calculator);
    }

    /**
     * We use this method to force future programmers to use the proper interface
     * implementation for calculation purphoses
     * @param Order $order
     * @param ICountryShippingCalc $calc
     * @return IPrice
     */
    private function country_calc(Order $order, ICountryShippingCalc $calc):IPrice
    {
        return $calc->calculate($order);
    }
}