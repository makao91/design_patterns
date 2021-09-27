<?php


namespace App\Shipping\AdditionalCalculations;

use \App\Contracts\ICountryShippingCalc;
use App\Contracts\IPrice;
use App\Contracts\IShippingOrder;
use App\Shipping\Price\PriceFactory;

class PremiumBox extends IAdditionalCalc
{

    protected function decorate(IPrice $shipping_cost, IShippingOrder $order):IPrice
    {
        if($order->isPremiumBox() )
        {
            $price = 0;
            switch($shipping_cost->getCurrencyCode())
            {
                case "PLN" : $price = 40; break;//PLN;
                case "GBP": $price = 20; break; //GBP
                case "$": $price = 17; break;//US $
                default: 17; break; // US $ for the rest of the world
            }
            $price_summary = $shipping_cost->getValue() + $price;
            $shipping_cost = $this->price_factory->create($shipping_cost->getCurrencyCode(), $price_summary);
        }

        return $shipping_cost;
    }
}