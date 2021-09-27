<?php
namespace App\Shipping\AdditionalCalculations;

use \App\Contracts\ICountryShippingCalc;
use \App\Contracts\IShippingOrder;
use \App\Contracts\IPrice;

class ClientShippingDiscount implements ICountryShippingCalc
{

    public function __construct(IShippingOrder $order)
    {
    }

    public function calculate(): IPrice
    {
        // TODO: Implement calculate() method.
    }
}