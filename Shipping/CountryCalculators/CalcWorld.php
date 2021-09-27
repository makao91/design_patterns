<?php


namespace App\Shipping\CountryCalculators;

use \App\Contracts\ICountryShippingCalc;
use App\Contracts\IPrice;
use App\Contracts\IShippingOrder;
use App\Shipping\Price\PriceUs;

class CalcWorld implements ICountryShippingCalc
{
    private IShippingOrder $order;

    public function __construct(IShippingOrder $order)
    {
        $this->order = $order;
    }

    public function calculate(): IPrice
    {
        //we don't care for the order total value, always add shipping cost
        return new PriceUs(299);
    }
}