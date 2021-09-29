<?php


namespace App\Shipping;

use App\Contracts\ICalculationsBuilder;
use App\Contracts\IShippingOrder;
use App\Shipping\CommonCalculations\AdditionalCalc;
use App\Shipping\Countries\CalculationsBuilder;
use App\Shipping\Countries\OtherCountries\BoxPricing\PremiumBoxWorld;
use App\Shipping\Countries\OtherCountries\CalculationsBuilderWorld as OthersBuilder;
use App\Shipping\Countries\OtherCountries\OrderTotalWorld;
use App\Shipping\Countries\OtherCountries\PriceWorld;
use App\Shipping\Countries\Pl\BoxPricing\PremiumBoxPl;
use App\Shipping\Countries\Pl\OrderTotalPl;
use App\Shipping\Countries\Pl\PricePl;
use App\Shipping\Countries\Uk\BoxPricing\PremiumBoxUk;
use App\Shipping\Countries\Uk\OrderTotalUk;
use App\Shipping\Countries\Uk\PriceUk;
use App\Shipping\Countries\Us\BoxPricing\PremiumBoxUs;
use App\Shipping\Countries\Us\OrderTotalUs;
use App\Shipping\Countries\Us\PriceUs;


class CountryCalcFactory
{
    public function create(IShippingOrder $order): ICalculationsBuilder
    {

        switch ($order->getCountry())
        {
            case "PL":
                $price = new PricePl(0);
                return new CalculationsBuilder($order, new PremiumBoxPl($price), new OrderTotalPl());
            case "UK":
                $price = new PriceUk(0);
                return new CalculationsBuilder($order, new PremiumBoxUk($price), new OrderTotalUk());
            case "US":
                $price = new PriceUs(0);
                return new CalculationsBuilder($order, new PremiumBoxUs($price), new OrderTotalUs());
            default:
                $price = new PriceWorld(0);
                return new CalculationsBuilder($order, new PremiumBoxWorld($price), new OrderTotalWorld());
        }
    }
}