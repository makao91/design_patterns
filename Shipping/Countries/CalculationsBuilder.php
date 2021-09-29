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

    public function useShippingDiscounts(IPrice $price): IPrice
    {
        $free_days = (new FreeDeliveryDays($price))->calculate($this->order);
        return (new ClientShippingDiscount($free_days))->calculate($this->order);
    }

    public function useOrderTotal():IPrice
    {
        return $this->order_total->calculate($this->order);
    }
}