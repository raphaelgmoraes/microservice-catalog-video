<?php

namespace Core\UseCase\DTO\Category;

class CategoryOutupDto
{
    /**
     * @param string $id
     * @param string $name
     * @param string $description
     * @param bool $isActive
     * @param string $createdAt
     */
    public function __construct(
        public string $id,
        public string $name,
        public string $description = '',
        public bool $isActive = true,
        public string $createdAt = '',
    ) {}
}
