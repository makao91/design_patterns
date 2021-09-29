<?php

namespace App;

class OrderFromAmazone
{
    public static function getOrder()
    {
        return [
            'data' => [
                "client" => 'amazone',
                'country' => "PL",
                'total' => 50,
                'shipping_discount_pl' => 0,
                'shipping_discount_uk' => 20,
                'shipping_discount_us' => 0,
                'box_type' => 'DEFAULT'
            ]
        ];
    }
}