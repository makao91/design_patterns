<?php
namespace App\Orders;

abstract class Order
{
    protected $data;

    public function __construct(array $order_mock)
    {
        $this->initOrder($order_mock);
    }

    /**
     * @param $data
     */
    public function initOrder($data): void
    {
        $this->data = $data;
    }
}