<?php


namespace App\Orders;


use App\Contracts\IShippingBox;

class BoxingPropertiesAdapter implements IShippingBox
{
    private Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function isPremiumBox():bool
    {
        return $this->order->isPremiumBox();
    }
}