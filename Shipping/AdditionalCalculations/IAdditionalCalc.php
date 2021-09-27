<?php


namespace App\Shipping\AdditionalCalculations;


use App\Contracts\IPrice;
use App\Contracts\IShippingOrder;

class IAdditionalCalc implements \App\Contracts\ICountryShippingCalc
{

    public function calculate(IShippingOrder $order): IPrice
    {
        // TODO: Implement calculate() method.
    }
}