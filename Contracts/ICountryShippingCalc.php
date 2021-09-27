<?php
namespace App\Contracts;

interface ICountryShippingCalc
{
    public function __construct(IShippingOrder $order);
    public function calculate():IPrice;
}