<?php
namespace Core\Domain\Repository;

use Core\Domain\Entity\Category;

interface CategoryRepositoryInterface
{
    public function insert(Category $category): Category;
    public function update(Category $category): Category;
    public function delete(string $id): bool;
    public function findById(string $id): ?Category;
    public function getIdsListIds(array $categoriesId = []): array;
    public function findAll(string $filter = '', string $sort = 'DESC'): array;
    public function paginate(
        string $filter = '',
        string $sort = 'DESC',
        int $page = 1, $totalPage = 15
    ): PaginationInterface;

}