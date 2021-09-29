<?php
namespace App\Shipping\Countries;

use App\Contracts\ICalculationsBuilder;
use App\Contracts\ICountryShippingCalc;
use App\Contracts\IPrice;
use App\Contracts\IShippingOrder;
use App\Shipping\CommonCalculations\ClientShippingDiscount;
use App\Shipping\CommonCalculations\FreeDeliveryDays;



class CalculationsBuilder implements ICalculationsBuilder
{
    protected IShippingOrder $order;
    protected ICountryShippingCalc $order_total;
    protected ICountryShippingCalc $box_pricing;

    public function __construct(IShippingOrder $order, ICountryShippingCalc $box_pricing, ICountryShippingCalc $order_total)
    {
        $this->order = $order;
        $this->order_total = $order_total;
        $this->box_pricing = $box_pricing;
    }

    public function useShippingDiscounts(IPrice $price): IPrice
    {
        $free_days_decorator = (new FreeDeliveryDays($price))->calculate($this->order);
        return (new ClientShippingDiscount($free_days_decorator))->calculate($this->order);
    }

    public function useOrderTotal():IPrice
    {
        return $this->order_total->calculate($this->order);
    }

    public function useBoxPricing(IPrice $price):IPrice
    {
        $box_pricing_class = get_class($this->box_pricing);
        $premium_box_decorator = new $box_pricing_class($price);

        return $premium_box_decorator->calculate($this->order);
    }


}