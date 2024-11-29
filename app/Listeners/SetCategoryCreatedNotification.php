<?php

namespace App\Listeners;

use App\Events\CategoryCreatedEvent;
use App\Services\AMQP\AMQPInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

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
        try {
            $this->amqpInterface->producer(
                config('microservices.rabbitmq.queue_name'),
                [
                    'app' => 'rabbitmq',
                    'info' => 'CategoryCreatedEvent',
                    'data' => $event->category->toArray(),
                ],
                config('microservices.rabbitmq.microservice_encoder_video.exchange')
            );
        } catch (\Exception $exception) {
            Log::error(
                "Class: " . get_class($this)
                . "Message Exception: " .$exception->getMessage()
            );
            report($exception);
        }
    }
}
