<?php
/**
 * @author  Manson
 * @date    5/30/22
 *
 * @package sandbox
 */

namespace App\Services\Brokers\Contracts;

interface BrokerInterface
{
    public function producer(): ProducerInterface;
    public function consumer(string $groupId): ConsumerInterface;
}
