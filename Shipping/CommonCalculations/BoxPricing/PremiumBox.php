<?php


namespace App\Shipping\AdditionalCalculations\BoxPricing;


use App\Contracts\IPrice;
use App\Contracts\IShippingOrder;
use App\Shipping\CommonCalculations\AdditionalCalc;

abstract class PremiumBox extends AdditionalCalc
{

    protected function decorate(IPrice $shipping_cost, IShippingOrder $order):IPrice
    {
        $boxing_properties = $order->getBoxingProperties();

        if($boxing_properties->isPremiumBox() )
        {
            $price_summary = $shipping_cost->getValue() + $this->country_price;
            $shipping_cost = $this->price_factory->create($shipping_cost->getCurrencyCode(), $price_summary);
        }

        return $shipping_cost;
    }
}