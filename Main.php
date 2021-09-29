<?php
namespace App;

use App\Contracts\IShippingOrder;
use App\Orders\Order;
use App\Orders\ShippingOrderAdapter;
use App\Shipping\ShippingCostCalculator;
use App\Contracts\IPrice;

class Main
{
    public function start(array $order)
    {
        $order_adapter = $this->getWrappedOrder($order);
        $shipping_cost = $this->makeShippingCalcultions($order_adapter);

        return $shipping_cost->getFomatedValue();
    }

    /**
     * we want to be independent as much as possible from the original messed Order object
     */
    private function getWrappedOrder($order):IShippingOrder
    {
        $immutable_order = new Order($order);

        return new ShippingOrderAdapter($immutable_order);
    }

    private function makeShippingCalcultions(IShippingOrder $order_adapter):IPrice
    {
        $calculator_facade = new ShippingCostCalculator();
        return $calculator_facade->calculate($order_adapter);
    }
}