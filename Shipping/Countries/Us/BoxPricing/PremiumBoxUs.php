<?php


namespace App\Shipping\Countries\Us\BoxPricing;

use App\Contracts\IPrice;
use App\Contracts\IShippingOrder;
use App\Shipping\CommonCalculations\AdditionalCalc;


class PremiumBoxUs extends AdditionalCalc
{
    protected $country_price = 17;

    protected function decorate(IPrice $shipping_cost, IShippingOrder $order):IPrice
    {
        if($order->isPremiumBox() )
        {
            $price_summary = $shipping_cost->getValue() + $this->country_price;
            $shipping_cost = $this->price_factory->create($shipping_cost->getCurrencyCode(), $price_summary);
        }

        return $shipping_cost;
    }
}