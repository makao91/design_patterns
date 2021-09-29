<?php
namespace App\Orders;

class GoogleOrderAdapter
{
    const POLSKA = 'polska';
    const UNITED_KINGDOM = 'england';

    public function adapt($order_mock)
    {
        return [
            'data' => [
                "client" => 'google',
                'country' => $this->convertCountrySymbol($order_mock['data']['europe_country']),
                'total' => $order_mock['data']['total_order_price'],
                'shipping_discount_pl' => $order_mock['data']['discount_to_poland'],
                'shipping_discount_uk' => $order_mock['data']['discount_to_england'],
                'shipping_discount_us' => 0,
                'box_type' => 'DEFAULT'
            ]
        ];
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