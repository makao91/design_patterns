<?php
namespace App;

use App\Orders\Order;
use App\Shipping\ShippingCostCalculator;
use App\Contracts\IPrice;

class Main
{
    public function start($country_code, $total)
    {
        $order = new Order($country_code, $total);

        /*@var IPrice */
        $shipping_cost = (new ShippingCostCalculator())->calculate($order);

        return $shipping_cost->getFomatedValue();
    }
}