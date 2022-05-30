<?php
/**
 * @author  Manson
 * @date    5/30/22
 *
 * @package sandbox
 */

namespace Manson\OrderGenerator;

use Faker\Factory;
use Illuminate\Support\ServiceProvider;
use Manson\OrderGenerator\Contracts\OrderGeneratorInterface;

class OrderGeneratorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(OrderGeneratorInterface::class, fn() => new Generator(Factory::create()));
    }
}
