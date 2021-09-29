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

     public function getType(): string
    {
        //remember we are working with dummy data
        //probably in real situtation you will get the type from database using the order_id
        return $this->order->boxType();
    }
}