<?php


namespace App\Shipping;

use App\Contracts\ICalculationsBuilder;
use App\Contracts\ICountryShippingCalc;
use App\Contracts\IShippingOrder;
use App\Shipping\Countries\OtherCountries\CalculationsBuilderWorld as OthersBuilder;
use App\Shipping\Countries\Pl\CalculationsBuilderPl as PlBuilder;
use App\Shipping\Countries\Uk\CalculationsBuilderUk as UkBuilder;
use App\Shipping\Countries\Us\CalculationsBuilderUs as UsBuilder;

class CountryCalcFactory
{
    public function create(IShippingOrder $order): ICalculationsBuilder
    {
        switch ($order->getCountry())
        {
            case "PL":
                return new PlBuilder($order);
            case "UK":
                return new UkBuilder($order);
            case "US":
                return new UsBuilder($order);
            default:
                return new OthersBuilder($order);
        }
    }
}