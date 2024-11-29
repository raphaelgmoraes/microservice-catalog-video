<?php

namespace App\Services\AMQP;

use Closure;

interface AMQPInterface
{
    /**
     * @param string $queue
     * @param array $payload
     * @param string $exchange
     * @return void
     */
    public function producer(string $queue, array $payload, string $exchange): void;

    /**
     * @param array $payload
     * @param string $exchange
     * @return void
     */
    public function producerFanout(array $payload, string $exchange): void;

    /**
     * @param string $queue
     * @param string $exchange
     * @param Closure|null $callback
     * @return void
     */
    public function consumer(string $queue, string $exchange, Closure $callback = null): void;
}
