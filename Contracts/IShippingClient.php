<?php
namespace App\Contracts;

interface IShippingClient extends IShippingOrder
{
    public function getShippingDiscount();
}