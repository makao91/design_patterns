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

    public function __construct(IShippingOrder $order)
    {
        $this->order = $order;
    }

    public function useShippingDiscounts(IPrice $price): IPrice
    {
        $with_free_days = (new FreeDeliveryDays($price))->calculate($this->order);
        return (new ClientShippingDiscount($with_free_days))->calculate($this->order);
    }

    abstract public function useOrderTotal():IPrice;

    abstract public function useBoxPricing(IPrice $price):IPrice;


}