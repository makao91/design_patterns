<?php
namespace App\Shipping\CountryCalculators;

use App\Contracts\ICountryShippingCalc;
use App\Contracts\IPrice;
use App\Contracts\IShippingOrder;
use App\Shipping\Price\PriceUs;

class CalcUs implements ICountryShippingCalc
{

    private IShippingOrder $order;

    public function __construct(IShippingOrder $order)
    {
        $this->order = $order;
    }

    public function calculate():IPrice
    {
        $total = $this->order->getTotalUs();

        if($total > 1000)
        {
            return new PriceUs(0);
        }
        //there will be more logic in the future
        return new PriceUs(250);
    }
}