<?php
namespace App\Shipping\CommonCalculations;

use \App\Contracts\ICountryShippingCalc;
use \App\Contracts\IShippingOrder;
use \App\Contracts\IPrice;
use \App\Shipping\Price\PriceFactory;

class ClientShippingDiscount extends AdditionalCalc
{
    protected function decorate(IPrice $shipping_cost, IShippingOrder $order):IPrice
    {
        if($order->getShippingDiscount() > 0 )
        {
            if($order->getShippingDiscount() >= $shipping_cost->getValue())
            {
                $shipping_cost = $this->price_factory->create($shipping_cost->getCurrencyCode(), 0);
            } else {
                $after_discount = $shipping_cost->getValue() - $order->getShippingDiscount();
                $shipping_cost = $this->price_factory->create($shipping_cost->getCurrencyCode(), $after_discount);
            }
        }

        return $shipping_cost;
    }
}