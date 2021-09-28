<?php
namespace App;

use App\Orders\Order;
use App\Orders\ShippingOrderAdapter;
use App\Shipping\CountryCalculators\CountryCalcFactory;
use App\Shipping\ShippingCostCalculator;
use App\Contracts\IPrice;

class Main
{
    public function start($country_code, $total, $discount = 0, $premium_box = false)
    {
        $immutable_order = new Order($country_code, $total, $discount, $premium_box);

        //we want to be independent as much as possible from the oryginal messed Order object
        $order_adapter = new ShippingOrderAdapter($immutable_order);

        $country_calculator = (new CountryCalcFactory())->create($order_adapter);

        /*@var IPrice */
        $shipping_cost = (new ShippingCostCalculator())->calculate($country_calculator, $order_adapter);

        return $shipping_cost->getFomatedValue();
    }
}