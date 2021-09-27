<?php
namespace App;

use App\Orders\Order;
use App\Shipping\ShippingCostCalculator;

class Main
{
    public function start($country_code, $total)
    {
        $order = new Order($country_code, $total);
        return $shipping_cost = (new ShippingCostCalculator())->calculate($order);
    }
}