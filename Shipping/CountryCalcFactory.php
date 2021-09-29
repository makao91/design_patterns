<?php


namespace App\Shipping;

use App\Contracts\ICalculationsBuilder;
use App\Contracts\IShippingOrder;
use App\Shipping\Countries\CalculationsBuilder;
use App\Shipping\Countries\OtherCountries\BoxPricing\PremiumBoxWorld;
use App\Shipping\Countries\OtherCountries\CalculationsBuilderWorld;
use App\Shipping\Countries\OtherCountries\OrderTotalWorld;
use App\Shipping\Countries\OtherCountries\PriceWorld;
use App\Shipping\Countries\Pl\BoxPricing\PremiumBoxPl;
use App\Shipping\Countries\Pl\CalculationsBuilderPl;
use App\Shipping\Countries\Pl\OrderTotalPl;
use App\Shipping\Countries\Pl\PricePl;
use App\Shipping\Countries\Uk\BoxPricing\PremiumBoxUk;
use App\Shipping\Countries\Uk\CalculationsBuilderUk;
use App\Shipping\Countries\Uk\OrderTotalUk;
use App\Shipping\Countries\Uk\PriceUk;
use App\Shipping\Countries\Us\BoxPricing\PremiumBoxUs;
use App\Shipping\Countries\Us\CalculationsBuilderUs;
use App\Shipping\Countries\Us\OrderTotalUs;
use App\Shipping\Countries\Us\PriceUs;


class CountryCalcFactory
{
    public function create(IShippingOrder $order): ICalculationsBuilder
    {

        switch ($order->getCountry())
        {
            case "PL":
                $order_total = new OrderTotalPl();
                return new CalculationsBuilderPl($order, $order_total);

            case "UK":
                $order_total = new OrderTotalUk();
                return new CalculationsBuilderUk($order, $order_total);

            case "US":
                $order_total = new OrderTotalUs();
                return new CalculationsBuilderUs($order, $order_total);

            default:

                $order_total = new OrderTotalWorld();
                return new CalculationsBuilderWorld($order, $order_total);

        }
    }
}