<?php
/**
 * @author  Manson
 * @date    5/30/22
 *
 * @package sandbox
 */

namespace Manson\OrderGenerator\Tests\Unit;

class OrderTest extends \Manson\OrderGenerator\Tests\TestCase
{
    /**
     * @test
     */
    public function it_implements_stringable_interface()
    {
        $generator = new \Manson\OrderGenerator\Objects\Order(
            20.5,
            [
                ['name' => 'Product A', 'quantity' => 3, 'price' => 3.5],
                ['name' => 'Product B', 'quantity' => 2, 'price' => 5],
            ]
        );

        $this->assertInstanceOf(\Stringable::class, $generator);
    }
}
