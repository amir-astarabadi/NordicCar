<?php

namespace App\DBRepository\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface BulkCreateInterface
{
    public function createMany(ModelDto $dto);
}
