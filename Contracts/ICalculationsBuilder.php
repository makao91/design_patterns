<?php
namespace App\Contracts;

interface ICalculationsBuilder
{
    public function useOrderTotal():IPrice;
    public function useShippingDiscounts(IPrice $price):IPrice;
    public function useBoxPricing(IPrice $price):IPrice;
}