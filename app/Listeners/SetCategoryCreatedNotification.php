<?php

namespace App\Listeners;

use App\Events\CategoryCreatedEvent;
use App\Services\AMQP\AMQPInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SetCategoryCreatedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct(public AMQPInterface $amqpInterface)
    {
       //
    }

    /**
     * Handle the event.
     */
    public function handle(CategoryCreatedEvent $event): void
    {
        $this->amqpInterface->producerFanout(
            $event->category->toArray(),
            config('microservices.rabbitmq.microservice_encoder_video.exchange')
        );
    }
}
