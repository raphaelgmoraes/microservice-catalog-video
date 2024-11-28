<?php

namespace Core\UseCase\DTO\Category\ListCategory;

class ListCategoriesOutputDto
{
    /**
     * @param array $items
     * @param int $total
     * @param int $currentPage
     * @param int $lastPage
     * @param int $firstPage
     * @param int $perPage
     * @param int $to
     * @param int $from
     */
    public function __construct(
        public array $items,
        public int $total,
        public int $currentPage,
        public int $lastPage,
        public int $firstPage,
        public int $perPage,
        public int $to,
        public int $from,
    ) {}
}