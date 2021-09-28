<?php
namespace App\Shipping\Countries\Us;

use App\Contracts\ICountryShippingCalc;
use App\Contracts\IPrice;
use App\Contracts\IShippingOrder;

class OrderTotalUs implements ICountryShippingCalc
{
    public function calculate(IShippingOrder $order):IPrice
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