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
        $this->calc_builder->useOrderTotal();
        $this->calc_builder->useShippingDiscounts();
        $this->calc_builder->useBoxPricing();
        return $this->calc_builder->makeCalculations();
    }
}