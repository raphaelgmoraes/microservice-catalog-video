<?php

namespace Core\UseCase\DTO\Category\ListCategory;

class ListCategoriesOutputDto
{
    public function __construct(
        public array $items,
        public int $total,
        public int $currentPage,
        public int $lastPage,
        public int $firstPage,
        public int $perPage,
        public int $to,
        public int $from,
    ) {
    }
}
