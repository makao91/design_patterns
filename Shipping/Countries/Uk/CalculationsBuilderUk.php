<?php
namespace App\Shipping\Countries\Uk;

use App\Contracts\ICalculationsBuilder;
use App\Contracts\ICountryShippingCalc;
use App\Contracts\IShippingOrder;
use App\Shipping\CommonCalculations\AdditionalCalc;
use App\Shipping\CommonCalculations\ClientShippingDiscount;
use App\Shipping\CommonCalculations\FreeDeliveryDays;
use App\Shipping\Countries\Uk\BoxPricing\PremiumBoxUk;
use App\Shipping\Countries\Uk\OrderTotalUk;

class CalculationsBuilderUk implements ICalculationsBuilder
{

    protected IShippingOrder $order;

    public function __construct(IShippingOrder $order)
    {
        $this->order = $order;
    }

    public function useOrderTotal():ICountryShippingCalc
    {
        return new OrderTotalUk();
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
            return new PremiumBoxUk($calculations_component);
        }

        return $calculations_component;
    }

    public function makeCalculations(ICountryShippingCalc $calculations_component): \App\Contracts\IPrice
    {
        return $calculations_component->calculate($this->order);
    }
}