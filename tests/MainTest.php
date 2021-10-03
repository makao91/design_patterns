<?php declare(strict_types=1);
namespace App\Tests;

use App\OrderClientOne;
use App\Orders\OrderClients;
use PHPUnit\Framework\TestCase;
use App\Main;

class MainTest extends TestCase
{
    /**
     * @feature Orders
     * @sceanrio Calculate Shipping Cost from amazone
     * @case to Poland without discounts
     * @test
     */
    public function start_needToPayPL()
    {
        $main  = new Main();
        $order_mock = [
                'data' => [
                    "client" => OrderClients::AMAZON,
                    'country' => "PL",
                    'total' => 50,
                    'shipping_discount_pl' => 0,
                    'shipping_discount_uk' => 0,
                    'shipping_discount_us' => 0,
                    'box_type' => 'DEFAULT'
                ]
            ];
        $result = $main->start($order_mock);

        $this->assertEquals('25PLN', $result);
    }

    /**
     * @feature Orders
     * @sceanrio Calculate Shipping Cost from amazone
     * @case to Poland with Client Shipping discount
     * @test
     */
    public function start_needToPayPLDiscount()
    {
        $main  = new Main();

        $order_mock = [
                'data' => [
                    "client" => OrderClients::AMAZON,
                    'country' => "PL",
                    'total' => 50,
                    'shipping_discount_pl' => 10,
                    'shipping_discount_uk' => 0,
                    'shipping_discount_us' => 0,
                    'box_type' => 'DEFAULT'
                ]
          ];

        $result = $main->start($order_mock);

        $this->assertEquals('15PLN', $result);
    }

    /**
     * @feature Orders
     * @sceanrio Calculate Shipping Cost from amazone
     * @case to Poland without Client Shipping discount and premium box
     * @test
     */
    public function start_needToPayPLDiscountANDPremiumBox()
    {
        $main  = new Main();
        $order_mock = [
                'data' => [
                    "client" => OrderClients::AMAZON,
                    'country' => "PL",
                    'total' => 50,
                    'shipping_discount_pl' => 10,
                    'shipping_discount_uk' => 0,
                    'shipping_discount_us' => 0,
                    'box_type' => 'PREMIUM_BOX'
                ]
            ];
        $result = $main->start($order_mock);

        $this->assertEquals('55PLN', $result);
    }

    /**
     * @feature Orders
     * @sceanrio Calculate Shipping Cost from amazone
     * @case to Poland free delivery above order total
     * @test
     */
    public function start_freeShippingPL()
    {
        $main  = new Main();

        $order_mock = [
                'data' => [
                    "client" => OrderClients::AMAZON,
                    'country' => "PL",
                    'total' => 150,
                    'shipping_discount_pl' => 0,
                    'shipping_discount_uk' => 0,
                    'shipping_discount_us' => 0,
                    'box_type' => 'DEFAULT'
                ]
            ];
        $result = $main->start($order_mock);

        $this->assertEquals('0PLN', $result);
    }

    /**
     * @feature Orders
     * @sceanrio Calculate Shipping Cost from amazone
     * @case to England free delivery above order total
     * @test
     */
    public function start_freeShippingUK()
    {
        $main  = new Main();
        $order_mock = [
                'data' => [
                    "client" => OrderClients::AMAZON,
                    'country' => "UK",
                    'total' => 450,
                    'shipping_discount_pl' => 0,
                    'shipping_discount_uk' => 0,
                    'shipping_discount_us' => 0,
                    'box_type' => 'DEFAULT'
                ]
            ];
        $result = $main->start($order_mock);

        $this->assertEquals('0GBP', $result);
    }

    /**
     * @feature Orders
     * @sceanrio Calculate Shipping Cost from amazone
     * @case to England free delivery above order total
     * @test
     */
    public function start_freeShippingUK_championsBox()
    {
        $main  = new Main();
        $order_mock = [
                'data' => [
                    "client" => OrderClients::AMAZON,
                    'country' => "UK",
                    'total' => 450,
                    'shipping_discount_pl' => 0,
                    'shipping_discount_uk' => 0,
                    'shipping_discount_us' => 0,
                    'box_type' => 'UEFA_CHAMPION'
                ]
            ];
        $result = $main->start($order_mock);

        $this->assertEquals('40GBP', $result);
    }

    /**
     * @feature Orders
     * @sceanrio Calculate Shipping Cost from amazone
     * @case to US free delivery above order total
     * @test
     */
    public function start_freeShippingUs()
    {
        $main  = new Main();
        $order_mock = [
                'data' => [
                    "client" => OrderClients::AMAZON,
                    'country' => "US",
                    'total' => 2450,
                    'shipping_discount_pl' => 0,
                    'shipping_discount_uk' => 0,
                    'shipping_discount_us' => 0,
                    'box_type' => 'DEFAULT'
                ]
            ];
        $result = $main->start($order_mock);

        $this->assertEquals('$0', $result);
    }

    /**
     * @feature Orders
     * @sceanrio Calculate Shipping Cost from amazone
     * @case to other countries - const delivery price in $
     * @test
     */
    public function start_costForUnknowCountries()
    {
        $main  = new Main();
        $order_mock = [
                'data' => [
                    "client" => OrderClients::AMAZON,
                    'country' => "Nigeria",
                    'total' => 2450,
                    'shipping_discount_pl' => 0,
                    'shipping_discount_uk' => 0,
                    'shipping_discount_us' => 0,
                    'box_type' => 'DEFAULT'
                ]
            ];
        $result = $main->start($order_mock);

        $this->assertEquals('ETH299', $result);
    }
    /**
     * @feature Orders
     * @sceanrio Calculate Shipping Cost from google
     * @case to Uk free delivery above order total
     * @test
     */
    public function start_freeShippingUkGoogle()
    {
        $main  = new Main();
        $order_mock = [
                'data' => [
                    "client" => 'google',
                    'europe_country' => "england",
                    'total_order_price' => 2450,
                    'discount_to_poland' => 0,
                    'discount_to_england' => 0,
                ]
        ];
        $result = $main->start($order_mock);

        $this->assertEquals('0GBP', $result);
    }
}