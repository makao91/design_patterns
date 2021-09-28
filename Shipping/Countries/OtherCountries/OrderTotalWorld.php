<?php


namespace App\Shipping\Countries\OtherCountries;

use \App\Contracts\ICountryShippingCalc;
use App\Contracts\IPrice;
use App\Contracts\IShippingOrder;
use App\Shipping\Price\PriceUs;

class OrderTotalWorld implements ICountryShippingCalc
{
    public function calculate(IShippingOrder $order): IPrice
    {
        //we don't care for the order total value, always add shipping cost
        return new PriceWorld(299);
    }
}