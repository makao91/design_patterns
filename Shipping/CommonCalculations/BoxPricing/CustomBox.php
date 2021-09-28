<?php


namespace App\Shipping\AdditionalCalculations\BoxPricing;

use \App\Contracts\ICountryShippingCalc;
use App\Contracts\ICustomBox;
use App\Contracts\IPrice;
use App\Contracts\IShippingOrder;
use App\Shipping\AdditionalCalculations\AdditionalCalc;
use App\Shipping\AdditionalCalculations\BoxPricing\PriceBoxFactory;
use App\Shipping\Price\PriceFactory;

class CustomBox extends AdditionalCalc implements ICustomBox
{

    protected IPrice $price;

    public function setPrice(IPrice $price)
    {
        $this->price = $price;

        if($price->getValue() < 0 ) {
            $this->price = $this->price_factory->create($price->getCurrencyCode(), 0);
        }
    }

    protected function decorate(IPrice $shipping_cost, IShippingOrder $order):IPrice
    {


        $price_summary = $shipping_cost->getValue() + $this->price->getValue();
        $shipping_cost = $this->price_factory->create($shipping_cost->getCurrencyCode(), $price_summary);

        return $shipping_cost;
    }
}