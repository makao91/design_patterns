<?php
namespace App\Contracts;

interface IShippingOrder
{
    public function getCountry();
    public function getTotalPl();
    public function getTotalUk();
    public function getTotalUs();

}