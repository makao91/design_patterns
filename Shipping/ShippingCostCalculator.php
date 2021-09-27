<?php
namespace App\Shipping;

use App\Contracts\ICountryShippingCalc;
use App\Contracts\IPrice;
use App\Contracts\IShippingOrder;
use App\Contracts\IShippingClient;

use App\Orders\Order;
use App\Shipping\AdditionalCalculations\ClientShippingDiscount;
use App\Shipping\AdditionalCalculations\FreeDeliveryDays;
use App\Shipping\AdditionalCalculations\PremiumBox;
use App\Shipping\CountryCalculators\CountryCalcFactory;

use App\Shipping\Price\PricePl;
use App\Shipping\Price\PriceUk;
use App\Shipping\Price\PriceUs;
use App\Shipping\Price\PriceFactory;

class ShippingCostCalculator
{
    private $price_factory ;
    public function __construct()
    {
        $this->price_factory = new PriceFactory();
    }
    public function calculate(ICountryShippingCalc $country_calc, IShippingClient $order):IPrice
    {
        //all future additional calculations related with shipping only should start/be added here
       // $shipping_cost = $country_calc->calculate($order);

        //include discounts for special premium days of delivery
        //IMPORTANT this has to be called before all other discounts calculations
        //e.g. Free delivery in special day is not equal that the premium box is free ;)
        $with_free_days = new FreeDeliveryDays($country_calc);

        $with_client_discount = new ClientShippingDiscount($with_free_days);
        $with_premium_boxing = new PremiumBox($with_client_discount);

        return $with_premium_boxing->calculate($order);
    }


}