<?php
namespace App\Contracts;

interface ICustomBox
{
    public function setPrice(IPrice $price);
}