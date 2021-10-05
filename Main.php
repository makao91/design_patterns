<?php
namespace App;

use App\Contracts\IShippingOrder;
use App\Orders\OrderFactory;
use App\Orders\ShippingOrderAdapter;
use App\Payments\PaymentGatewayFactory;
use App\Shipping\ShippingCostCalculator;
use App\Contracts\IPrice;

class Main
{

    public function start(array $order, string $payment_method)
    {
        $immutable_order = (new OrderFactory($order))->create();

        $shipping_cost = $this->makeShippingCalculations(new ShippingOrderAdapter($immutable_order));

        $payment_gateway = (new PaymentGatewayFactory($payment_method))->create($immutable_order, $shipping_cost);


        return $payment_gateway->pay();
    }


    private function makeShippingCalculations(IShippingOrder $order_adapter):IPrice
    {
        $calculator_facade = new ShippingCostCalculator();
        return $calculator_facade->calculate($order_adapter);
    }
}