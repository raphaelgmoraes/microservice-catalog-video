<?php

namespace Core\UseCase\DTO\Category\CreateCategory;

class CategoryCreateInputDto
{
    /**
     * @param string $name
     * @param string $description
     * @param bool $active
     */
    public function __construct(
        public string $name,
        public string $description = '',
        public bool $active = true,
    ) {}
}
