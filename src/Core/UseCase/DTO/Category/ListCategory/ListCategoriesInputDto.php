<?php

namespace Core\UseCase\DTO\Category\ListCategory;

class ListCategoriesInputDto
{
    /**
     * @param string $filter
     * @param string $sort
     * @param int $page
     * @param int $totalPage
     */
    public function __construct(
        public string $filter = '',
        public string $sort = 'DESC',
        public int $page = 1,
        public int $totalPage = 15,
    ) {}
}