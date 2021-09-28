<?php
namespace App;

use App\Contracts\IShippingOrder;
use App\Orders\Order;
use App\Orders\ShippingOrderAdapter;
use App\Shipping\CountryCalculators\CountryCalcFactory;
use App\Shipping\ShippingCostCalculator;
use App\Contracts\IPrice;

class Main
{
    public function start($country_code, $total, $discount = 0, $premium_box = false)
    {
        $order_adapter = $this->getWrappedOrder($country_code, $total, $discount, $premium_box);
        $shipping_cost = $this->makeShippingCalcultions($order_adapter);

        return $shipping_cost->getFomatedValue();
    }

    private function getWrappedOrder($country_code, $total, $discount = 0, $premium_box = false):IShippingOrder
    {
        $immutable_order = new Order($country_code, $total, $discount, $premium_box);

        //we want to be independent as much as possible from the oryginal messed Order object
        /*@var IShippingOrder $order_adapter */
        return new ShippingOrderAdapter($immutable_order);
    }

    private function makeShippingCalcultions(IShippingOrder $order_adapter):IPrice
    {
        $calc_factory = new CountryCalcFactory();
        $country_calculator = $calc_factory->create($order_adapter->getCountry());

        $calculator_facade = new ShippingCostCalculator();
        return $calculator_facade->calculate($country_calculator, $order_adapter);
    }
}