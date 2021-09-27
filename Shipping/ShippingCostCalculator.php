<?php
namespace App\Shipping;

use App\Orders\Order;

class ShippingCostCalculator
{
    public function calculate(Order $order)
    {
        $country = $order->getCountry();

        switch($country)
        {
            case "PL":
                $total = $order->getTotalPl();
                if($total > 100)
                {
                    return '0PLN';
                }
                //there will be more logic in the future
                return '25PLN';

            case "UK":
                $total = $order->getTotalUk();

                if($total > 300)
                {
                    return '0'."GBP";
                }
                //there will be more logic in the future
                return '25'."GBP";
            case "US":
                $total = $order->getTotalUs();

                if($total > 1000)
                {
                    return '$0';
                }
                //there will be more logic in the future
                return '$250';
        }
    }
}