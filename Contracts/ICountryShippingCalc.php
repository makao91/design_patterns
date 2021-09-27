<?php
namespace App\Contracts;

interface ICountryShippingCalc
{
    public function calculate($order):IPrice;
}