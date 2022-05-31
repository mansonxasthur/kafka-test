<?php
/**
 * @author  Manson
 * @date    5/30/22
 *
 * @package sandbox
 */

namespace App\Services\Brokers\Contracts;

interface ProducerInterface
{
    public function topic(string $topic): ProducerInterface;
    public function push(string $payload, int $timeout): void;
}
