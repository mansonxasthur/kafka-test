<?php

namespace Manson\OrderGenerator\Tests\Unit;
use Manson\OrderGenerator\Objects\Order;
use Manson\OrderGenerator\Contracts\OrderGeneratorInterface;

/**
 * @author  Manson
 * @date    5/30/22
 *
 * @package sandbox
 */
class OrderGeneratorTest extends \Manson\OrderGenerator\Tests\TestCase
{
    /**
     * @test
     */
    public function it_implements_order_generator_interface()
    {
        $generator = new \Manson\OrderGenerator\Generator(\Faker\Factory::create());

        $this->assertInstanceOf(OrderGeneratorInterface::class, $generator);
    }

    /**
     * @test
     */
    public function it_generates_an_order()
    {
        $generator = new \Manson\OrderGenerator\Generator(\Faker\Factory::create());

        $this->assertInstanceOf(Order::class, $generator->generate());
    }
}
