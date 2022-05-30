<?php
/**
 * @author  Manson
 * @date    5/30/22
 *
 * @package sandbox
 */

namespace Manson\OrderGenerator;

use Manson\OrderGenerator\Objects\Order;
use Manson\OrderGenerator\Contracts\OrderGeneratorInterface;

class Generator implements OrderGeneratorInterface
{
    public function __construct(
        protected \Faker\Generator $faker,
        protected int $numberOfProducts = 3,
    )
    {
    }

    public function generate(): Order
    {
        $products = $this->generateProducts();
        $amount = $this->calculateAmount($products);

        return new Order($amount, $products);
    }

    protected function generateProducts(): array
    {
        $products = [];

        for ($i = 0; $i < $this->numberOfProducts; $i++) {
            $products[] = [
                'name' => $this->faker->name(),
                'quantity' => rand(1, 5),
                'price' => $this->faker->randomFloat(2)
            ];
        }

        return $products;
    }

    protected function calculateAmount(array $products): float
    {
        return array_reduce($products, function($amount, $product) {
            $amount += $product['quantity'] * $product['price'];
            return $amount;
        }, 0);
    }
}
