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

class ConsumeOrders extends \Illuminate\Console\Command
{
    protected $signature = 'consume:orders {--service=default}';
    protected $description = 'Consume orders from broker';
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
        $consumer = $this->broker->consumer('orders');
        $consumer->topics(['created-order']);
           while(true) {
               try {
                   $order = $consumer->consume();
                   if (empty($order)) {
                       continue;
                   }

                   $this->info('Order consumed with id (' . $order['id'] . ') on service [' . $this->option('service') .']');
               } catch (\Throwable $e) {
                   $this->error($e->getMessage());
               }
           }
    }
}
