<?php
namespace App\Shipping\CountryCalculators;

use App\Contracts\ICountryShippingCalc;
use App\Contracts\IPrice;
use App\Contracts\IShippingOrder;
use App\Shipping\Price\PricePl;

class CalcPl implements ICountryShippingCalc
{
    private IShippingOrder $order;

    public function __construct(IShippingOrder $order)
    {
        $this->order = $order;
    }

    public function calculate():IPrice
    {
        $total = $this->order->getTotalPl();
        if($total > 100)
        {
            return new PricePl(0);
        }
        //there will be more logic in the future
        return new PricePl(25);
    }
}