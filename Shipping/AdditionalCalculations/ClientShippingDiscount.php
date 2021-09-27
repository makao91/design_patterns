<?php
namespace App\Shipping\AdditionalCalculations;

use \App\Contracts\ICountryShippingCalc;
use \App\Contracts\IShippingOrder;
use \App\Contracts\IPrice;
use \App\Shipping\Price\PriceFactory;

class ClientShippingDiscount implements ICountryShippingCalc
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