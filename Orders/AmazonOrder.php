<?php
namespace App\Orders;

class AmazonOrder extends Order implements IOrder
{
    public function getCountry(): string
    {
        return $this->data['country'];
    }

    public function getTotalPl(): float
    {
        return $this->data['total'];
    }

    public function getTotalUk(): float
    {
        return $this->data['total'];
    }

    public function getTotalUs(): float
    {
        return $this->data['total'];
    }

    public function getClientShippingDiscountPL(): float
    {
        return $this->data['shipping_discount_pl'];
    }

    public function getClientShippingDiscountUk(): float
    {
        return $this->data['shipping_discount_uk'];
    }

    public function getClientShippingDiscountWORLD(): float
    {
        return $this->data['shipping_discount_us'];
    }

    public function boxType(): string
    {
        return $this->data['box_type'];
    }
}