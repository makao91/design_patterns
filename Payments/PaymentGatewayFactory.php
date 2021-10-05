<?php

declare(strict_types=1);

namespace App\Payments;

use App\Payments\Gateways\ApplePay;
use App\Payments\Gateways\Blik;
use App\Payments\Gateways\CreditCard;
use App\Payments\Gateways\DotPay;
use App\Payments\Gateways\DupaPay;
use App\Payments\Gateways\GooglePay;
use App\Payments\Gateways\Paypal;
use App\Payments\Gateways\Przelewy24;
use App\Payments\Gateways\Tpay;
use App\Payments\Gateways\UPay;

class PaymentGatewayFactory
{
    private string $payment_method;

    public function __construct(string $payment_method)
    {
        $this->payment_method = $payment_method;
    }

    public function create($order, $shipping_cost)
    {
        switch ($this->payment_method){
            case 'u_pay':
                return new UPay($order, $shipping_cost);
            case 'apple_pay':
                return new ApplePay($order, $shipping_cost);
            case 'blik':
                return new Blik($order, $shipping_cost);
            case 'credit_card':
                return new CreditCard($order, $shipping_cost);
            case 'dot_pay':
                return new DotPay($order, $shipping_cost);
            case 'dupa_pay':
                return new DupaPay($order, $shipping_cost);
            case 'google_pay':
                return new GooglePay($order, $shipping_cost);
            case 'paypal':
                return new Paypal($order, $shipping_cost);
            case 'przelewy_24':
                return new Przelewy24($order, $shipping_cost);
            case 't_pay':
                return new Tpay($order, $shipping_cost);
            default:
                throw new Exception('Invalid gateway');
        }
    }
}