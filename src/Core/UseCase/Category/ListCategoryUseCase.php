<?php

namespace Core\UseCase\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\DTO\Category\CategoryInputDto;
use Core\UseCase\DTO\Category\CategoryOutupDto;

class ListCategoryUseCase
{
    protected CategoryRepositoryInterface $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(CategoryInputDto $input): CategoryOutupDto
    {
        $category = $this->repository->findById($input->id);

        return new CategoryOutupDto(
            id: $category->id(),
            name: $category->name,
            description: $category->description,
            active: $category->active,
            created_at: $category->createdAt(),
        );
    }
}
