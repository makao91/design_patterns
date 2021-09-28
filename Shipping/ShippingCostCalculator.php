<?php
namespace App\Shipping;

use App\Contracts\ICountryShippingCalc;
use App\Contracts\IPrice;
use App\Contracts\IShippingOrder;
use App\Contracts\IShippingClient;

use App\Shipping\AdditionalCalculations\ClientShippingDiscount;
use App\Shipping\AdditionalCalculations\FreeDeliveryDays;
use App\Shipping\AdditionalCalculations\BoxPricing\PremiumBox;
use App\Shipping\CountryCalculators\CountryCalcFactory;
use App\Shipping\Price\PriceFactory;

class ShippingCostCalculator
{
    protected IShippingOrder $order;
    private CountryCalcFactory $calc_factory;

    public function __construct()
    {
        $this->calc_factory = new CountryCalcFactory();
    }

    /**
     * Use country calculator and decorate it with additional calculations
     * @param ICountryShippingCalc $country_calc
     * @param IShippingOrder $order
     * @return IPrice
     */
    public function calculate(IShippingOrder $order):IPrice
    {
        $country_calculator = $this->getCountryCalc($order);

        //include discounts for special premium days of delivery
        //IMPORTANT this has to be called before all other discounts calculations
        //e.g. Free delivery in special day is not equal that the premium box is free ;)
        $with_free_days = new FreeDeliveryDays($country_calculator);

        $with_client_discount = new ClientShippingDiscount($with_free_days);
        $with_premium_boxing = new PremiumBox($with_client_discount);

        return $with_premium_boxing->calculate($order);
    }

    private function getCountryCalc(IShippingOrder $order):ICountryShippingCalc
    {
        return $this->calc_factory->create($order->getCountry());
    }

}