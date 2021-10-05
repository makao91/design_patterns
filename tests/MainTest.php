<?php declare(strict_types=1);
namespace App\Tests;

use App\Orders\OrderClients;
use App\Payments\Entities\PaymentsMethod;
use PHPUnit\Framework\TestCase;
use App\Main;

class MainTest extends TestCase
{
    /**
     * @feature Orders
     * @sceanrio Calculate Shipping Cost from amazone, Upay
     * @case to Poland without discounts
     * @test
     */
    public function start_needToPayPL()
    {
        $main  = new Main();
        $payment_method = PaymentsMethod::U_PAY;
        $order_mock = [
                    "client" => OrderClients::AMAZON,
                    'country' => "PL",
                    'total' => 50,
                    'shipping_discount_pl' => 0,
                    'shipping_discount_uk' => 0,
                    'shipping_discount_us' => 0,
                    'box_type' => 'DEFAULT'
            ];
        $result = $main->start($order_mock, $payment_method);

        $this->assertEquals('Payed by Upay: 75PLN', $result);
    }

    /**
     * @feature Orders
     * @sceanrio Calculate Shipping Cost from amazone, apple_pay
     * @case to Poland with Client Shipping discount
     * @test
     */
    public function start_needToPayPLDiscount()
    {
        $main  = new Main();
        $payment_method = PaymentsMethod::APPLE_PAY;

        $order_mock = [
                    "client" => OrderClients::AMAZON,
                    'country' => "PL",
                    'total' => 50,
                    'shipping_discount_pl' => 10,
                    'shipping_discount_uk' => 0,
                    'shipping_discount_us' => 0,
                    'box_type' => 'DEFAULT'
              ];

        $result = $main->start($order_mock, $payment_method);

        $this->assertEquals('Payed by ApplePay: 65PLN', $result);
    }

    /**
     * @feature Orders
     * @sceanrio Calculate Shipping Cost from amazone, blik
     * @case to Poland without Client Shipping discount and premium box
     * @test
     */
    public function start_needToPayPLDiscountANDPremiumBox()
    {
        $main  = new Main();
        $payment_method = PaymentsMethod::BLIK;

        $order_mock = [
                    "client" => OrderClients::AMAZON,
                    'country' => "PL",
                    'total' => 50,
                    'shipping_discount_pl' => 10,
                    'shipping_discount_uk' => 0,
                    'shipping_discount_us' => 0,
                    'box_type' => 'PREMIUM_BOX'
            ];
        $result = $main->start($order_mock, $payment_method);

        $this->assertEquals('Payed by Blik: 105PLN', $result);
    }

    /**
     * @feature Orders
     * @sceanrio Calculate Shipping Cost from amazone, dupa_pay
     * @case to Poland free delivery above order total
     * @test
     */
    public function start_freeShippingPL()
    {
        $main  = new Main();
        $payment_method = PaymentsMethod::DUPA_PAY;

        $order_mock = [
                    "client" => OrderClients::AMAZON,
                    'country' => "PL",
                    'total' => 150,
                    'shipping_discount_pl' => 0,
                    'shipping_discount_uk' => 0,
                    'shipping_discount_us' => 0,
                    'box_type' => 'DEFAULT'
            ];
        $result = $main->start($order_mock, $payment_method);

        $this->assertEquals('Payed by DupaPay: 150PLN', $result);
    }

    /**
     * @feature Orders
     * @sceanrio Calculate Shipping Cost from amazone, przelewy_24
     * @case to England free delivery above order total
     * @test
     */
    public function start_freeShippingUK()
    {
        $main  = new Main();
        $payment_method = PaymentsMethod::PRZELEWY_24;

        $order_mock = [
                    "client" => OrderClients::AMAZON,
                    'country' => "UK",
                    'total' => 450,
                    'shipping_discount_pl' => 0,
                    'shipping_discount_uk' => 0,
                    'shipping_discount_us' => 0,
                    'box_type' => 'DEFAULT'
            ];
        $result = $main->start($order_mock, $payment_method);

        $this->assertEquals('Payed by Przelewy24: 450GBP', $result);
    }

    /**
     * @feature Orders
     * @sceanrio Calculate Shipping Cost from amazone, payed by CREDIT_CARD
     * @case to England free delivery above order total
     * @test
     */
    public function start_freeShippingUK_championsBox()
    {
        $main  = new Main();
        $payment_method = PaymentsMethod::CREDIT_CARD;

        $order_mock = [
                    "client" => OrderClients::AMAZON,
                    'country' => "UK",
                    'total' => 450,
                    'shipping_discount_pl' => 0,
                    'shipping_discount_uk' => 0,
                    'shipping_discount_us' => 0,
                    'box_type' => 'UEFA_CHAMPION'
            ];
        $result = $main->start($order_mock, $payment_method);

        $this->assertEquals('Payed by CreditCard: 490GBP', $result);
    }

    /**
     * @feature Orders
     * @sceanrio Calculate Shipping Cost from amazone, t_pay
     * @case to US free delivery above order total
     * @test
     */
    public function start_freeShippingUs()
    {
        $main  = new Main();
        $payment_method = PaymentsMethod::T_PAY;

        $order_mock = [
                    "client" => OrderClients::AMAZON,
                    'country' => "US",
                    'total' => 2450,
                    'shipping_discount_pl' => 0,
                    'shipping_discount_uk' => 0,
                    'shipping_discount_us' => 0,
                    'box_type' => 'DEFAULT'
            ];
        $result = $main->start($order_mock, $payment_method);

        $this->assertEquals('Payed by Tpay: 2450$', $result);
    }

    /**
     * @feature Orders
     * @sceanrio Calculate Shipping Cost from amazone, paypal
     * @case to other countries - const delivery price in $
     * @test
     */
    public function start_costForUnknowCountries()
    {
        $main  = new Main();
        $payment_method = PaymentsMethod::PAYPAL;

        $order_mock = [
                    "client" => OrderClients::AMAZON,
                    'country' => "Nigeria",
                    'total' => 2450,
                    'shipping_discount_pl' => 0,
                    'shipping_discount_uk' => 0,
                    'shipping_discount_us' => 0,
                    'box_type' => 'DEFAULT'
            ];
        $result = $main->start($order_mock, $payment_method);

        $this->assertEquals('Payed by Paypal: 2749ETH', $result);
    }
    /**
     * @feature Orders
     * @sceanrio Calculate Shipping Cost from google, dot_pay
     * @case to Uk free delivery above order total
     * @test
     */
    public function start_freeShippingUkGoogle()
    {
        $main  = new Main();
        $payment_method = PaymentsMethod::DOT_PAY;

        $order_mock = [
                    "client" => 'google',
                    'europe_country' => "england",
                    'total_order_price' => 2450,
                    'discount_to_poland' => 0,
                    'discount_to_england' => 0,
                    'box_type' => 'DEFAULT'
        ];
        $result = $main->start($order_mock, $payment_method);

        $this->assertEquals('Payed by DaotPay: 2450GBP', $result);
    }
}