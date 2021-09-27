<?php
namespace App\Shipping;

use App\Contracts\IPrice;
use App\Orders\Order;
use App\Shipping\Price\PricePl;
use App\Shipping\Price\PriceUk;
use App\Shipping\Price\PriceUs;

class ShippingCostCalculator
{
    public function calculate(Order $order):IPrice
    {
        $country = $order->getCountry();

        switch($country)
        {
            case "PL":
                $total = $order->getTotalPl();
                if($total > 100)
                {
                    return new PricePl(0);
                }
                //there will be more logic in the future
                return new PricePl(25);

            case "UK":
                $total = $order->getTotalUk();

                if($total > 300)
                {
                    return new PriceUk(0);
                }
                //there will be more logic in the future
                return  new PriceUk(25);
            case "US":
                $total = $order->getTotalUs();

                if($total > 1000)
                {
                    return new PriceUs(0);
                }
                //there will be more logic in the future
                return new PriceUs(250);
        }
    }
}