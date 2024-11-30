<?php

namespace App\Console\Commands;

use App\Events\CategoryCreatedEvent;
use App\Models\Category;
use App\Services\AMQP\AMQPInterface;
use Illuminate\Console\Command;

class RabbitmqProducer extends Command
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

        return 0;
    }
}
