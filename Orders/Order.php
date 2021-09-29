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
    private $country = "PL";
    private $total = 50;
    private $shipping_discount = 0;
    private $box_type = "DEFAULT";

    public function __construct($country_code, $total, $shipping_discount, $box_type)
    {
        $this->country = $country_code;
        $this->total = $total;
        $this->shipping_discount = $shipping_discount;
        $this->box_type = $box_type;
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

    public function getClientDiscount(){
        return 10;
    }

    public function getClientShippingDiscountPL()
    {
        return $this->shipping_discount;
    }

    public function getClientShippingDiscountEU()
    {
        return 20;
    }

    public function getClientShippingDiscountWORLD()
    {
        return 0;
    }

    public function boxType()
    {
        return $this->box_type;
    }
    //please assume that there will be a lot more of code inside of this class
    //imagine the worst code which you ever seen... this one is worse
}