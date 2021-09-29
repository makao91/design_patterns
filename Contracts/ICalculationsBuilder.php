<?php
namespace App\Contracts;

interface ICalculationsBuilder
{
    public function useOrderTotal():ICountryShippingCalc;
    public function useShippingDiscounts(ICountryShippingCalc $calculations_component):ICountryShippingCalc;
    public function useBoxPricing(ICountryShippingCalc $calculations_component):ICountryShippingCalc;
    public function makeCalculations(ICountryShippingCalc $calculations_component):IPrice;
}