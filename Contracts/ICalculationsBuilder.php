<?php
namespace App\Contracts;

interface ICalculationsBuilder
{
    public function useOrderTotal();
    public function useShippingDiscounts();
    public function useBoxPricing();
    public function makeCalculations():IPrice;
}