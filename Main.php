<?php
namespace App;

use App\Orders\Order;
use App\Orders\ShippingOrderAdapter;
use App\Shipping\CountryCalculators\CountryCalcFactory;
use App\Shipping\ShippingCostCalculator;
use App\Contracts\IPrice;

class Main
{
    public function start($country_code, $total)
    {
        $immutable_order = new Order($country_code, $total);

        //we wante to be independent as much as possible from the oryginal messed Order object
        $order_adapter = new ShippingOrderAdapter($immutable_order);

        $country_calculator = (new CountryCalcFactory())->create($order_adapter);

        /*@var IPrice */
        $shipping_cost = (new ShippingCostCalculator())->calculate($country_calculator);

        return $shipping_cost->getFomatedValue();
    }
}