<?php


namespace App\Shipping\CommonCalculations\BoxPricing;


use App\Contracts\IPrice;
use App\Contracts\IShippingOrder;
use App\Shipping\CommonCalculations\AdditionalCalc;

abstract class PremiumBox extends AdditionalCalc
{
    abstract protected function getCurrentType();
    abstract protected function getCountryPrice();

    protected function decorate(IPrice $shipping_cost, IShippingOrder $order):IPrice
    {
        $boxing_properties = $order->getBoxingProperties();

        if($boxing_properties->getType() ===  $this->getCurrentType())
        {
            $price_summary = $shipping_cost->getValue() + $this->getCountryPrice();
            $shipping_cost = $this->price_factory->create($shipping_cost->getCurrencyCode(), $price_summary);
        }

        return $shipping_cost;
    }
}