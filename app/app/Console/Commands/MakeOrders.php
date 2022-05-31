<?php
/**
 * @author  Manson
 * @date    5/30/22
 *
 * @package sandbox
 */

namespace App\Console\Commands;

use App\Services\Brokers\Kafka\Broker;
use Illuminate\Support\Facades\Config;
use App\Services\Brokers\Contracts\BrokerInterface;
use Manson\OrderGenerator\Contracts\OrderGeneratorInterface;

class MakeOrders extends \Illuminate\Console\Command
{
    protected $signature = 'make:orders';
    protected $description = 'Generates orders and push them to broker';
    protected BrokerInterface $broker;

    public function __construct(
        protected OrderGeneratorInterface $generator,
    )
    {
        parent::__construct();

        $this->broker = new Broker(new \RdKafka\Conf(), Config::get('brokers'));
    }

    public function handle()
    {
           while(true) {
               sleep(rand(1,5));
               try {
                   $order = $this->generator->generate();
                   $producer = $this->broker->producer();
                   $producer->topic('created-order');
                   $producer->push((string) $order);

                   $this->info('Order pushed with id (' . $order->id() . ')');
               } catch (\Throwable $e) {
                   $this->error($e->getMessage());
               }
           }
    }
}
