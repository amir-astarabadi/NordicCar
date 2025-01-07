<?php

namespace App\DBRepository\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

interface PaginateInterface
{
    public function paginate(int $page = 1, int $perpage = 20): LengthAwarePaginator;
}
