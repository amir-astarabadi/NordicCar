<?php

namespace App\DBRepository\Concretes\Customer;

use App\DBRepository\Contracts\CRUDInterface;
use App\DBRepository\Contracts\ModelDto;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class CustomerRepository implements CRUDInterface
{
    public function create(ModelDto $dto): Model
    {
        $user = new User();
        foreach($dto->toArray() as $property => $value){
            $user->{$property} = $value;
        }
        $user->save();
        return $user;
    }

    public function update(Model $user, ModelDto $dto): Model
    {
        $user->update($dto->toArray());
        return $user;
    }

    public function find(int $identifier, $key = 'id'): ?User
    {
        return User::where($key, $identifier)->first();
    }

    public function delete(Model $user): bool
    {
        return $user->delete();
    }
}
