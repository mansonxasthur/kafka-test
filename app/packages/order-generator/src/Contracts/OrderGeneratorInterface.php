<?php
/**
 * @author  Manson
 * @date    5/30/22
 *
 * @package sandbox
 */

namespace Manson\OrderGenerator\Contracts;

use Manson\OrderGenerator\Objects\Order;

interface OrderGeneratorInterface
{
    public function generate(): Order;
}
