<?php

namespace App;

class MockOrderFromGoogle
{
    public static function getOrder()
    {
        return [
            'data' => [
                "client" => 'google',
                'europe_country' => "polska",
                'total_order_price' => 50,
                'discount_to_poland' => 0,
                'discount_to_england' => 20,
            ]
        ];
    }
}