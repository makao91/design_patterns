<?php


namespace App\Shipping\AdditionalCalculations;


use App\Contracts\ICountryShippingCalc;
use App\Contracts\IPrice;
use App\Shipping\Price\PriceFactory;

class PriceBoxFactory
{
    protected $price_factory ;

    public function __construct()
    {
        $this->price_factory = new PriceFactory();
    }

    public function create($country_code):IPrice
    {
        switch($country_code)
        {
            case "PLN" : $price = 40; break;//PLN;
            case "GBP": $price = 20; break; //GBP
            case "$": $price = 17; break;//US $
            default:
                $price = 17;
                $country_code = '$';
                break; // US $ for the rest of the world
        }

        return $this->price_factory->create($country_code, $price);
    }
}