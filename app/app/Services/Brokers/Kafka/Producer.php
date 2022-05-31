<?php
/**
 * @author  Manson
 * @date    5/30/22
 *
 * @package sandbox
 */

namespace App\Services\Brokers\Kafka;

class Producer implements \App\Services\Brokers\Contracts\ProducerInterface
{
    protected $topic = null;

    public function __construct(
        protected \RdKafka\Producer $producer
    )
    {}

    public function topic(string $topic): static
    {
        $this->topic = $this->producer->newTopic($topic);
        return $this;
    }

    public function push(string $payload, int $timeout = 1000): void
    {
        if (!$this->topic) {
            throw new \Exception('Missing topic!!');
        }

        $this->topic->produce(RD_KAFKA_PARTITION_UA, 0, $payload);
        $this->producer->flush($timeout);
    }
}
