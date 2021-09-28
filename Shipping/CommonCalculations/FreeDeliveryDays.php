<?php


namespace App\Shipping\CommonCalculations;


use App\Contracts\ICountryShippingCalc;
use App\Contracts\IPrice;
use App\Contracts\IShippingOrder;
use App\Shipping\Price\PriceFactory;

class FreeDeliveryDays extends AdditionalCalc
{
    protected function decorate(IPrice $shipping_cost, IShippingOrder $order):IPrice
    {
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