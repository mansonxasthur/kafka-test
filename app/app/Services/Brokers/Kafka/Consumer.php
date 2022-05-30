<?php
/**
 * @author  Manson
 * @date    5/30/22
 *
 * @package sandbox
 */

namespace App\Services\Brokers\Kafka;

use App\Services\Brokers\Contracts\ConsumerInterface;

class Consumer implements \App\Services\Brokers\Contracts\ConsumerInterface
{
    protected array $topics = [];

    public function __construct(
        protected \RdKafka\KafkaConsumer $consumer
    )
    {}

    public function topics(array $topics): ConsumerInterface
    {
        $this->topics = $topics;
        return $this;
    }

    public function consume(int $timeout = 12 * 1000): array
    {
        if (empty($this->topics)) {
            throw new \Exception('Missing topics!!');
        }
        $this->consumer->subscribe($this->topics);
        $message = $this->consumer->consume($timeout);
        if (!isset($message->payload)) {
            return [];
        }
        return json_decode($message->payload, true);
    }
}
