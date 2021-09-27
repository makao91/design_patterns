<?php


namespace App\Shipping\AdditionalCalculations;


use App\Contracts\ICountryShippingCalc;
use App\Contracts\IPrice;
use App\Contracts\IShippingOrder;
use App\Shipping\Price\PriceFactory;

class FreeDeliveryDays implements \App\Contracts\ICountryShippingCalc
{
    private ICountryShippingCalc $calc;
    private $price_factory ;

    public function __construct(ICountryShippingCalc $calc)
    {
        $this->calc = $calc;
        $this->price_factory = new PriceFactory();
    }

    public function calculate(IShippingOrder $order): IPrice
    {
        $shipping_cost = $this->calc->calculate($order);

        if($this->isSpecialDay())
        {
            $shipping_cost = $this->price_factory->create($shipping_cost->getCurrencyCode(), 0);
        }

        return $shipping_cost;
    }

    private function isSpecialDay()
    {
        return false;
    }
}