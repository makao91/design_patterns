<?php


namespace App\Shipping;


use App\Contracts\ICalculate;
use App\Contracts\ICalculationsBuilder;
use App\Contracts\IPrice;

class CalculationsDirector implements ICalculate
{
    private ICalculationsBuilder $calc_builder;

    public function __construct(ICalculationsBuilder $calc_builder)
    {
        $this->calc_builder = $calc_builder;
    }

    public function calculate():IPrice
    {
        //this is the main shipping cost calculation
        $calculator = $this->calc_builder->useOrderTotal();

        //these has to be always calculated as first after total order value
        $decorate = $this->calc_builder->useShippingDiscounts($calculator);

        //other calculations
        return $this->calc_builder->useBoxPricing($decorate);
    }
}