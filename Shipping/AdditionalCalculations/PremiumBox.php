<?php


namespace App\Shipping\AdditionalCalculations;

use \App\Contracts\ICountryShippingCalc;
use App\Contracts\IPrice;
use App\Contracts\IShippingOrder;
use App\Shipping\Price\PriceFactory;

class PremiumBox extends AdditionalCalc
{

    protected function decorate(IPrice $shipping_cost, IShippingOrder $order):IPrice
    {
        if($order->isPremiumBox() )
        {
            $price = 0;
            ///get price box per country
            $price_per_country = (new PriceBoxFactory())->create($shipping_cost->getCurrencyCode());

            $price_summary = $shipping_cost->getValue() + $price_per_country->getValue();
            $shipping_cost = $this->price_factory->create($shipping_cost->getCurrencyCode(), $price_summary);
        }

        return $shipping_cost;
    }
}