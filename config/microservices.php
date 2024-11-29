<?php

return [
    'rabbitmq' => [
        'queue_name' => env('RABBITMQ_QUEUE'),
        'hosts' => [
            [
                'host' => env('RABBITMQ_HOST', '127.0.0.1'),
                'port' => env('RABBITMQ_PORT', 5672),
                'user' => env('RABBITMQ_USER', 'guest'),
                'password' => env('RABBITMQ_PASSWORD', 'guest'),
                'vhost' => env('RABBITMQ_VHOST', '/'),
            ],
        ],
        'microservice_encoder_video' => [
            'exchange' => env('RABBITMQ_EXCHANGE', 'exchange_encoder_video'),
            'queue_name' => 'encoder_video',
            'exchange_producer' => 'amq.direct',
        ],
    ],

    'kafka' => [],
];
