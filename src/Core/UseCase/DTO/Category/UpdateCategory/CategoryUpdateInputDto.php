<?php

namespace Core\UseCase\DTO\Category\UpdateCategory;

class CategoryUpdateInputDto
{
    /**
     * @param string $id
     * @param string $name
     * @param string|null $description
     * @param bool $active
     */
    public function __construct(
        public string $id,
        public string $name,
        public string|null $description = null,
        public bool $active = true,
    ) {}
}
