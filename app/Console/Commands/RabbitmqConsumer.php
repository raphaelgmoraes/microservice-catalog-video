<?php

namespace App\Console\Commands;

use App\Services\AMQP\AMQPInterface;
use Illuminate\Console\Command;

class RabbitmqConsumer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:rabbitmq-consumer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'RabbitMQ consumer description';

    public function __construct(public AMQPInterface $amqp)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $callback = function ($msg) {
            echo ' [x] Received ', $msg->getBody(), "\n";
        };

        $this->amqp->consumer(
            queue: config('microservices.rabbitmq.queue_name'),
            exchange: config('microservices.rabbitmq.microservice_encoder_video.exchange_producer'),
            callback: $callback
        );

        return 0;
    }

    /**
     * @param  \PhpAmqpLib\Message\AMQPMessage  $message
     */
    public function process_message($message)
    {
        echo "\n--------\n";
        echo $message->body;
        echo "\n--------\n";

        $message->ack();

        // Send a message with the string "quit" to cancel the consumer.
        if ($message->body === 'quit') {
            $message->getChannel()->basic_cancel($message->getConsumerTag());
        }
    }
}
