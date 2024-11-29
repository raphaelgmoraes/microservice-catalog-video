<?php

namespace Core\Domain\Events;

use Core\Domain\Entity\Category;

class CategoryCreatedEvent implements EventInterface
{
    public function __construct(protected Category $category)
    {}

    public function getEventName(): string
    {
        return 'video.created';
    }

    public function getPayload(): array
    {
        return [
            'resource_id' => $this->model->id(),
            'payload' => $this->model->toArray(),
        ];
    }
}
