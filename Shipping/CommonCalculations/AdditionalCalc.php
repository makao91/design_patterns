<?php


namespace App\Shipping\CommonCalculations;
use \App\Contracts\ICountryShippingCalc;

use App\Contracts\IPrice;
use App\Contracts\IShippingOrder;
use App\Shipping\PriceFactory;

abstract class AdditionalCalc implements ICountryShippingCalc
{

    protected ICountryShippingCalc $calc;
    protected $price_factory ;

    public function __construct(ICountryShippingCalc $calculations_component)
    {
        $this->calc = $calculations_component;
        $this->price_factory = new PriceFactory();
    }

    public function calculate(IShippingOrder $order): IPrice
    {
        $shipping_cost = $this->calc->calculate($order);
        return $this->decorate($shipping_cost, $order);
    }

    abstract protected function decorate(IPrice $shipping_cost, IShippingOrder $order): IPrice;
}