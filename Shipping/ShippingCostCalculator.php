<?php
namespace App\Shipping;

use App\Contracts\ICountryShippingCalc;
use App\Contracts\IPrice;
use App\Contracts\IShippingOrder;
use App\Contracts\IShippingClient;

use App\Orders\Order;
use App\Shipping\CountryCalculators\CountryCalcFactory;
use App\Shipping\Price\PriceFactory;
use App\Shipping\Price\PricePl;
use App\Shipping\Price\PriceUk;
use App\Shipping\Price\PriceUs;

class ShippingCostCalculator
{
    private $price_factory ;
    public function __construct()
    {
        $this->price_factory = new PriceFactory();
    }
    public function calculate(ICountryShippingCalc $calc, IShippingClient $client, IShippingOrder $order):IPrice
    {
        //all future additional calculations related with shipping only should start/be added here
        $shipping_cost = $calc->calculate();

        //include discounts for special premium days of delivery
        //IMPORTANT this has to be called before all other discounts calculations
        if($this->isSpecialDay())
        {
            $shipping_cost = $this->price_factory->create($shipping_cost->getCurrencyCode(), 0);
        }

        //include client discount code
        if($client->getShippingDiscount() > 0 )
        {
            if($client->getShippingDiscount() >= $shipping_cost->getValue())
            {
                $shipping_cost = $this->price_factory->create($shipping_cost->getCurrencyCode(), 0);
            } else {
                $after_discount = $shipping_cost->getValue() - $client->getShippingDiscount();
                $shipping_cost = $this->price_factory->create($shipping_cost->getCurrencyCode(), $after_discount);
            }
        }

        //include additional money for premium type box
        if($order->isPremiumBox() )
        {
            $price = 0;
            switch($shipping_cost->getCurrencyCode())
            {
                case "PLN" : $price = 40; break;//PLN;
                case "GBP": $price = 20; break; //GBP
                case "$": $price = 17; break;//US $
                default: 17; break; // US $ for the rest of the world
            }
            $price_summary = $shipping_cost->getValue() + $price;
            $shipping_cost = $this->price_factory->create($shipping_cost->getCurrencyCode(), $price_summary);
        }

        return $shipping_cost;
    }

    private function isSpecialDay()
    {
        return false;
    }
}