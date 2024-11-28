<?php

namespace Core\UseCase\DTO\Category;

class CategoryInputDto
{
    /**
     * @param string $id
     */
    public function __construct(public string $id = '') {}
}