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
    public function start($country_code, $total, $discount = 0, $box_type = 'DEFAULT')
    {
        $order_adapter = $this->getWrappedOrder($country_code, $total, $discount, $box_type);
        $shipping_cost = $this->makeShippingCalcultions($order_adapter);

        return $shipping_cost->getFomatedValue();
    }

    /**
     * we want to be independent as much as possible from the original messed Order object
     */
    private function getWrappedOrder($country_code, $total, $discount = 0, $premium_box = false):IShippingOrder
    {
        $immutable_order = new Order($country_code, $total, $discount, $premium_box);

        return new ShippingOrderAdapter($immutable_order);
    }

    private function makeShippingCalcultions(IShippingOrder $order_adapter):IPrice
    {
        $calculator_facade = new ShippingCostCalculator();
        return $calculator_facade->calculate($order_adapter);
    }
}