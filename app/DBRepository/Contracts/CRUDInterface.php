<?php

namespace App\DBRepository\Contracts;

use Illuminate\Database\Eloquent\Model;

interface CRUDInterface
{
    public function create(ModelDto $dto): Model;

    public function update(Model $model, ModelDto $dto): Model;

    public function find(int $identifier, $key = 'id'): ?Model;

    public function delete(Model $model): bool;
}
