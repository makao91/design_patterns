<?php


namespace App\Orders;


class ShippingOrderAdapter implements \App\Contracts\IShippingOrder
{
    private Order $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function getCountry()
    {
        return $this->order->getCountry();
    }

    public function getTotalPl()
    {
        return $this->order->getTotalPl();
    }

    public function getTotalUk()
    {
        return $this->order->getTotalUk();
    }

    public function getTotalUs()
    {
        return $this->order->getTotalUs();
    }
}