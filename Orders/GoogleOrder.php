<?php
namespace App\Orders;

use phpDocumentor\Reflection\Types\This;

class GoogleOrder extends Order implements IOrder
{
    const POLSKA = 'polska';
    const UNITED_KINGDOM = 'england';

    public function getCountry(): string
    {
        return $this->convertCountrySymbol($this->data['europe_country']);
    }

    public function getTotalPl(): float
    {
        return $this->data['total_order_price'];
    }

    public function getTotalUk(): float
    {
        return $this->data['total'];
    }

    public function getTotalUs(): float
    {
        return $this->data['total'];
    }

    public function getClientShippingDiscountPL(): float
    {
        return $this->data['discount_to_poland'];
    }

    public function getClientShippingDiscountUk(): float
    {
        return $this->data['discount_to_england'];
    }

    public function getClientShippingDiscountWORLD(): float
    {
        return 0;
    }

    public function boxType(): string
    {
        return $this->data['box_type'];
    }

    private function convertCountrySymbol(string $europe_country)
    {
        switch ($europe_country){
            case self::POLSKA:
                return 'PL';
            case self::UNITED_KINGDOM:
                return 'UK';
            default:
                return 'unknown';
        }
    }
}