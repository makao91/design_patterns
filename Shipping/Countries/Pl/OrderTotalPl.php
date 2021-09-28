<?php
namespace App\Shipping\Countries\Pl;

use App\Contracts\ICountryShippingCalc;
use App\Contracts\IPrice;
use App\Contracts\IShippingOrder;

class OrderTotalPl implements ICountryShippingCalc
{
    public function calculate(IShippingOrder $order):IPrice
    {
        $total = $order->getTotalPl();
        if($total > 100)
        {
            return new PricePl(0);
        }
        //there will be more logic in the future
        return new PricePl(25);
    }
}