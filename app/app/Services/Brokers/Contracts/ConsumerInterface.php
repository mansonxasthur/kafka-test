<?php
/**
 * @author  Manson
 * @date    5/30/22
 *
 * @package sandbox
 */

namespace App\Services\Brokers\Contracts;

interface ConsumerInterface
{
    public function topics(array $topics): ConsumerInterface;
    public function consume(int $timeout): array;
}
