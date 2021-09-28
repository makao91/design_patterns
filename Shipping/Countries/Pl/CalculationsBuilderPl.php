<?php
namespace App\Shipping\Countries\Pl;

use App\Contracts\ICalculationsBuilder;
use App\Contracts\ICountryShippingCalc;
use App\Contracts\IShippingOrder;
use App\Shipping\CommonCalculations\ClientShippingDiscount;
use App\Shipping\CommonCalculations\FreeDeliveryDays;
use App\Shipping\Countries\Pl\BoxPricing\PremiumBoxPl;
use App\Shipping\Countries\Us\BoxPricing\PremiumBoxUs;

class CalculationsBuilderPl implements ICalculationsBuilder
{
    protected IShippingOrder $order;

    public function __construct(IShippingOrder $order)
    {
        $this->order = $order;
    }

    public function useOrderTotal():ICountryShippingCalc
    {
        return new OrderTotalPl();
    }

    public function useShippingDiscounts(ICountryShippingCalc $calculations_component)
    {
        $with_free_days = new FreeDeliveryDays($calculations_component);
        return new ClientShippingDiscount($with_free_days);
    }

    public function useBoxPricing(ICountryShippingCalc $calculations_component)
    {
        if($this->order->isPremiumBox() )
        {
            return new PremiumBoxPl($calculations_component);
        }

        return $calculations_component;
    }

    public function makeCalculations(ICountryShippingCalc $calculations_component): \App\Contracts\IPrice
    {
        return $calculations_component->calculate($this->order);
    }
}