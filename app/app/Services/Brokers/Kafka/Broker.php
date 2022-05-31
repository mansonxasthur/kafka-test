<?php
/**
 * @author  Manson
 * @date    5/30/22
 *
 * @package sandbox
 */

namespace App\Services\Brokers\Kafka;

use App\Services\Brokers\Contracts\ProducerInterface;
use App\Services\Brokers\Contracts\ConsumerInterface;

class Broker implements \App\Services\Brokers\Contracts\BrokerInterface
{
    public function __construct(
        protected \RdKafka\Conf $config,
        protected array $brokers
    )
    {
    }

    public function producer(): ProducerInterface
    {
        $this->config->set('metadata.broker.list', implode(',', $this->brokers));
        $producer = new \RdKafka\Producer($this->config);
        return new Producer($producer);
    }

    public function consumer(string $groupId): ConsumerInterface
    {
        $this->config->set('group.id', $groupId);
        $this->config->set('metadata.broker.list', implode(',', $this->brokers));
        $this->config->set('auto.offset.reset', 'earliest');

        return new Consumer(new \RdKafka\KafkaConsumer($this->config));
    }
}
