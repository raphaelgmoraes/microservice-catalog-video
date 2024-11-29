<?php

namespace App\Console\Commands;

use App\Events\CategoryCreatedEvent;
use App\Models\Category;
use App\Services\AMQP\AMQPInterface;
use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitmqConsumer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:rabbitmq-producer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'RabbitMQ producer description';

    public function __construct(public AMQPInterface $amqp)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $category = Category::factory()->create();
        event(new CategoryCreatedEvent($category));

//        $this->amqp->consumer(
//            queue: config('microservices.queue_name'),
//            exchange: config('microservices.micro_encoder_go.exchange_producer'),
//        );


        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $channel->exchange_declare('logs', 'fanout', false, false, false);

        list($queue_name, ,) = $channel->queue_declare("", false, false, true, false);

        $channel->queue_bind($queue_name, 'logs');

        echo " [*] Waiting for logs. To exit press CTRL+C\n";

        $callback = function ($msg) {
            echo ' [x] ', $msg->getBody(), "\n";
        };

        $channel->basic_consume($queue_name, '', false, true, false, false, $callback);

        try {
            $channel->consume();
        } catch (\Throwable $exception) {
            echo $exception->getMessage();
        }

        $channel->close();
        $connection->close();

        return 0;
    }
}
