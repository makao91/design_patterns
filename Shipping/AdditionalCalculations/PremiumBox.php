<?php


namespace App\Shipping\AdditionalCalculations;

use \App\Contracts\ICountryShippingCalc;
use App\Contracts\IPrice;
use App\Contracts\IShippingOrder;
use App\Shipping\Price\PriceFactory;

class PremiumBox implements ICountryShippingCalc
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
        return $this->decorate($shipping_cost, $order);
    }

    protected function decorate(IPrice $shipping_cost, IShippingOrder $order)
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