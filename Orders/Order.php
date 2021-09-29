<?php
namespace App\Orders;

/**
 * This is a dummy class, which only imitate the real class
 * In reality there will be much more code inside of it, and for each country
 * we will have custom algorithms to calculate the order
 *
 * In this tutorial we don't care about this class.
 * Let say it is a shity library and you can't change it
 * Class Order
 * @package App\Orders
 */
class Order
{
    private $country;
    private $total;
    private $shipping_discount_pl;
    private $box_type;
    private $shipping_discount_uk;
    private $shipping_discount_us;

    public function __construct($order_mock)
    {
        $this->country = $order_mock['data']['country'];
        $this->total = $order_mock['data']['total'];
        $this->shipping_discount_pl = $order_mock['data']['shipping_discount_pl'];
        $this->shipping_discount_uk = $order_mock['data']['shipping_discount_uk'];
        $this->shipping_discount_us = $order_mock['data']['shipping_discount_us'];
        $this->box_type = $order_mock['data']['box_type'];
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getTotalPl()
    {
        return $this->total;
    }

    public function getTotalUk()
    {
        return $this->total;
    }

    public function getTotalUs()
    {
        return $this->total;
    }

    public function getClientShippingDiscountPL()
    {
        return $this->shipping_discount_pl;
    }

    public function getClientShippingDiscountUk()
    {
        return $this->shipping_discount_uk;
    }

    public function getClientShippingDiscountWORLD()
    {
        return $this->shipping_discount_us;
    }

    public function boxType()
    {
        return $this->box_type;
    }
    //please assume that there will be a lot more of code inside of this class
    //imagine the worst code which you ever seen... this one is worse
}