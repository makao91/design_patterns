<?php declare(strict_types=1);
namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Main;

class MainTest extends TestCase
{
    /**
     * @test
     */
    public function start_needToPayPL()
    {
        $main  = new Main();
        $result = $main->start("PL", 50);

        $this->assertEquals('25PLN', $result);
    }

    /**
     * @test
     */
    public function start_freeShippingPL()
    {
        $main  = new Main();
        $result = $main->start("PL", 150);

        $this->assertEquals('0PLN', $result);
    }

    /**
     * @test
     */
    public function start_freeShippingUK()
    {
        $main  = new Main();
        $result = $main->start("UK", 450);

        $this->assertEquals('0GBP', $result);
    }

    /**
     * @test
     */
    public function start_freeShippingUs()
    {
        $main  = new Main();
        $result = $main->start("US", 2450);

        $this->assertEquals('$0', $result);
    }

    /**
     * @test
     */
    public function start_costForUnknowCountries()
    {
        $main  = new Main();
        $result = $main->start("Nigeria", 2450);

        $this->assertEquals('$200', $result);
    }
}