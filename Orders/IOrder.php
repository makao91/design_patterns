<?php
namespace App\Orders;

interface IOrder
{
    public function getCountry(): string;

    public function getTotalPl(): float;

    public function getTotalUk(): float;

    public function getTotalUs(): float;

    public function getClientShippingDiscountPL(): float;

    public function getClientShippingDiscountUk(): float;

    public function getClientShippingDiscountWORLD(): float;

    public function boxType(): string;
}