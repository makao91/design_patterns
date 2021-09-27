<?php
namespace App\Contracts;

interface ICountryShippingCalc
{
     public function calculate(IShippingOrder $order):IPrice;
}