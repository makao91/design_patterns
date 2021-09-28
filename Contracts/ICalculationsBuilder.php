<?php
namespace App\Contracts;

interface ICalculationsBuilder
{
    public function useOrderTotal():ICountryShippingCalc;
    public function useShippingDiscounts(ICountryShippingCalc $calculations_component);
    public function useBoxPricing(ICountryShippingCalc $calculations_component);
    public function makeCalculations(ICountryShippingCalc $calculations_component):IPrice;
}