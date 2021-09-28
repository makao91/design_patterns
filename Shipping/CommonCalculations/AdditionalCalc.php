<?php


namespace App\Shipping\CommonCalculations;
use \App\Contracts\ICountryShippingCalc;

use App\Contracts\IPrice;
use App\Contracts\IShippingOrder;
use App\Shipping\PriceFactory;

abstract class AdditionalCalc implements ICountryShippingCalc
{

    protected IPrice $price;
    protected $price_factory ;

    public function __construct(IPrice $price)
    {
        $this->price = $price;
        $this->price_factory = new PriceFactory();
    }

    public function calculate(IShippingOrder $order): IPrice
    {
        return $this->decorate($this->price, $order);
    }

    abstract protected function decorate(IPrice $shipping_cost, IShippingOrder $order): IPrice;
}