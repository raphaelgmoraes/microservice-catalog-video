<?php

namespace Core\UseCase\DTO\Category\ListCategory;

class ListCategoriesInputDto
{
    public function __construct(
        public string $filter = '',
        public string $sort = 'DESC',
        public int $page = 1,
        public int $totalPage = 15,
    ) {
    }
}
