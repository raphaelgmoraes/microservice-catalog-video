<?php

namespace Core\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\UseCase\DTO\Category\CreateCategory\CategoryCreateInputDto;
use Core\UseCase\DTO\Category\CreateCategory\CategoryCreateOutputDto;
use src\Core\Domain\Repository\CategoryRepositoryInterface;



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
            isActive: $input->isActive,
        );

        $newCategory = $this->repository->insert($category);

        return new CategoryCreateOutputDto(
            id: $newCategory->id(),
            name: $newCategory->name,
            description: $category->description,
            isActive: $category->isActive,
            createdAt: $category->createdAt(),
        );
    }
}