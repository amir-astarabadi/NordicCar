<?php

namespace App\DBRepository\Concretes\Product;

use App\DBRepository\Contracts\PaginateInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use App\DBRepository\Contracts\CRUDInterface;
use App\DBRepository\Contracts\ModelDto;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductRepository implements CRUDInterface, PaginateInterface
{
    public function create(ModelDto $dto): Model
    {
        $product = new Product();
        foreach($dto->toArray() as $property => $value){
            $product->{$property} = $value;
        }
        $product->save();
        return $product;
    }

    public function update(Model $product, ModelDto $dto): Model
    {
        $product->update($dto->toArray());
        return $product;
    }

    public function find(int $identifier, $key = 'id'): ?Product
    {
        return Product::where($key, $identifier)->first();
    }

    public function delete(Model $product): bool
    {
        return $product->delete();
    }

    public function paginate(int $page = 1, int $perpage = 20): LengthAwarePaginator
    {
        return Product::query()->paginate(page: $page, perPage: $perpage);
    }
}
