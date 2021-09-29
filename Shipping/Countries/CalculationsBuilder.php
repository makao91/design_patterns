<?php
namespace App\Shipping\Countries;

use App\Contracts\ICalculationsBuilder;
use App\Contracts\ICountryShippingCalc;
use App\Contracts\IPrice;
use App\Contracts\IShippingOrder;
use App\Shipping\CommonCalculations\ClientShippingDiscount;
use App\Shipping\CommonCalculations\FreeDeliveryDays;



abstract class CalculationsBuilder implements ICalculationsBuilder
{
    protected IShippingOrder $order;
    protected ICountryShippingCalc $order_total;

    public function __construct(IShippingOrder $order, ICountryShippingCalc $order_total)
    {
        $this->order = $order;
        $this->order_total = $order_total;
    }

    public function useShippingDiscounts(ICountryShippingCalc $calculations_component):ICountryShippingCalc
    {
        $free_days_decorator = new FreeDeliveryDays($calculations_component);
        $client_discount_decorator =  new ClientShippingDiscount($free_days_decorator);

        return $client_discount_decorator;
    }

    public function useOrderTotal():ICountryShippingCalc
    {
        return $this->order_total;
    }

    public function makeCalculations(ICountryShippingCalc $calculations_component): IPrice
    {
        return $calculations_component->calculate($this->order);
    }
}