<?php
namespace App\Shipping\Countries\Uk;

use App\Contracts\ICountryShippingCalc;
use App\Contracts\IPrice;
use App\Contracts\IShippingOrder;

class OrderTotalUk implements ICountryShippingCalc
{
    public function calculate(IShippingOrder $order):IPrice
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