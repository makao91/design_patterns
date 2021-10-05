<?php
namespace App\Contracts;

interface IPrice {

    public function __construct(float $value);

    public function getValue();
    public function getCurrencyCode();
    public function getFomatedValue();
}