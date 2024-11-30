<?php

namespace Core\UseCase\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\DTO\Category\ListCategory\ListCategoriesInputDto;
use Core\UseCase\DTO\Category\ListCategory\ListCategoriesOutputDto;

class ListCategoriesUseCase
{
    protected CategoryRepositoryInterface $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(ListCategoriesInputDto $input): ListCategoriesOutputDto
    {
        $categories = $this->repository->paginate(
            filter: $input->filter,
            sort: $input->sort,
            page: $input->page,
            totalPage: $input->totalPage,
        );

        return new ListCategoriesOutputDto(
            items: $categories->items(),
            total: $categories->total(),
            currentPage: $categories->currentPage(),
            lastPage: $categories->lastPage(),
            firstPage: $categories->firstPage(),
            perPage: $categories->perPage(),
            to: $categories->to(),
            from: $categories->from(),
        );
    }
}
