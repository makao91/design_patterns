<?php
namespace App\Shipping\CountryCalculators;

use App\Contracts\IPrice;
use App\Shipping\Price\PriceUk;

class CalcUk implements \App\Contracts\ICountryShippingCalc
{

    public function calculate($order):IPrice
    {
        $total = $order->getTotalUk();

        if($total > 300)
        {
            return new PriceUk(0);
        }
        //there will be more logic in the future
        return  new PriceUk(25);
    }
}