<?php

namespace App\DBRepository\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface BulkFindInterface
{
    public function findMany(ModelDto $dto): Collection;
}
