<?php


namespace App\Orders;


use App\Contracts\IShippingBox;
use App\Contracts\IShippingClient;
use App\Contracts\IShippingOrder;

class ShippingOrderAdapter implements IShippingOrder
{
    private Order $order;
    private IShippingBox $boxing;

    public function __construct($order)
    {
        $this->order = $order;
        $this->boxing = new BoxingPropertiesAdapter($order);
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

    public function getShippingDiscount()
    {
       switch($this->order->getCountry())
       {
           case "PL":
               return $this->order->getClientShippingDiscountPL();
           case "UK":
               return $this->order->getClientShippingDiscountEU();
           case "US":
               return $this->order->getClientShippingDiscountWORLD();
           default:
               return $this->order->getClientShippingDiscountWORLD();
       }
    }

    public function getBoxingProperties(): IShippingBox
    {
        return $this->boxing;
    }
}