<?php
namespace App\Orders;

class OrderFactory
{
    private array $order;

    public function __construct(array $order)
    {
        $this->order = $order;
    }
    public function create(): IOrder
    {
        switch ($this->order['client']) {
            case OrderClients::GOOGLE:
                return new GoogleOrder($this->order);
            case OrderClients::AMAZON:
                return new AmazonOrder($this->order);
            default:
                throw new \Exception('Invalid order type');
        }
    }
}