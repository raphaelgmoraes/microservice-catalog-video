<?php

namespace Core\UseCase\DTO\Category\DeleteCategory;

class CategoryDeleteOutputDto
{
    /**
     * @param bool $success
     */
    public function __construct(public bool $success) {}
}