<?php

namespace Core\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Events\CategoryCreatedEvent;
use Core\UseCase\DTO\Category\CreateCategory\CategoryCreateInputDto;
use Core\UseCase\DTO\Category\CreateCategory\CategoryCreateOutputDto;
use Core\Domain\Repository\CategoryRepositoryInterface;

class CreateCategoryUseCase
{
    protected CategoryRepositoryInterface $repository;

    /**
     * @param CategoryRepositoryInterface $repository
     */
    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CategoryCreateInputDto $input
     * @return CategoryCreateOutputDto
     */
    public function execute(CategoryCreateInputDto $input): CategoryCreateOutputDto
    {
        $category = new Category(
            name: $input->name,
            description: $input->description,
            active: $input->active,
        );

        $newCategory = $this->repository->insert($category);

        return new CategoryCreateOutputDto(
            id: $newCategory->id(),
            name: $newCategory->name,
            description: $category->description,
            active: $category->active,
            created_at: $category->createdAt(),
        );
    }
}
