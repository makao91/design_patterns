<?php
namespace App\Shipping\CountryCalculators;

use App\Contracts\IPrice;
use App\Shipping\Price\PriceUs;

class CalcUs implements \App\Contracts\ICountryShippingCalc
{

    public function calculate($order):IPrice
    {
        $total = $order->getTotalUs();

        if($total > 1000)
        {
            return new PriceUs(0);
        }
        //there will be more logic in the future
        return new PriceUs(250);
    }
}