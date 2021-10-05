<?php

declare(strict_types=1);

namespace App\Payments;

use App\Contracts\IPrice;
use App\Orders\IOrder;
use App\Payments\Contracts\IPayment;

abstract class PaymentService implements IPayment
{
    protected IOrder $order;
    private IPrice $shipping_cost;

    public function __construct(IOrder $order, IPrice $shipping_cost)
    {
        $this->order = $order;
        $this->shipping_cost = $shipping_cost;
    }

    public function pay()
    {
        $get_total_value = $this->getOrderCost($this->shipping_cost->getCurrencyCode());
        $get_shipping_cost = $this->shipping_cost->getValue();
        $formated_total_cost = ($get_total_value + $get_shipping_cost).$this->shipping_cost->getCurrencyCode();

        return $this->useExclusiveGatewayLogic($formated_total_cost);
    }

    private function getOrderCost($get_currency_code)
    {
        switch ($get_currency_code){
            case 'PL':
                return $this->order->getTotalPl();
            case 'UK':
                return $this->order->getTotalUk();
            case 'US':
            default:
                return $this->order->getTotalUs();
        }
    }
}