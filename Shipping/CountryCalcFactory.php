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
                $premium_box = new PremiumBoxPl($price);
                $order_total = new OrderTotalPl();
                break;

            case "UK":
                $price = new PriceUk(0);
                $premium_box = new PremiumBoxUk($price);
                $order_total = new OrderTotalUk();
                break;

            case "US":
                $price = new PriceUs(0);
                $premium_box = new PremiumBoxUs($price);
                $order_total = new OrderTotalUs();
                break;

            default:
                $price = new PriceWorld(0);
                $premium_box = new PremiumBoxWorld($price);
                $order_total = new OrderTotalWorld();
                break;

        }

        return new CalculationsBuilder($order, $premium_box, $order_total);
    }
}