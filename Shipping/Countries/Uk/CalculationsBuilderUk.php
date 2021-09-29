<?php
namespace App\Shipping\Countries\Uk;

use App\Contracts\IPrice;
use App\Shipping\Countries\CalculationsBuilder;
use App\Shipping\Countries\Uk\BoxPricing\PremiumBoxUk;
use App\Shipping\Countries\Uk\BoxPricing\UefaChampionBox;


class CalculationsBuilderUk extends CalculationsBuilder
{
    public function useBoxPricing(IPrice $price):IPrice
    {
        $with_premium_box = (new PremiumBoxUk($price))->calculate($this->order);
        $with_uefa_champion = (new UefaChampionBox($with_premium_box))->calculate($this->order);

        return $with_uefa_champion;
    }
}