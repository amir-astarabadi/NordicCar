<?php

namespace App\DBRepository\Concretes\OrderItem;

use App\DBRepository\Concretes\Product\ProductRepository;
use App\DBRepository\Contracts\BulkCreateInterface;
use App\DBRepository\Contracts\CRUDInterface;
use App\DBRepository\Contracts\ModelDto;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class OrderItemRepository implements CRUDInterface, BulkCreateInterface
{

    public function __construct(private ProductRepository $productRepository){}

    public function create(ModelDto $dto): Model
    {
        $order = new Order();
        foreach($dto->toArray() as $property => $value){
            $order->{$property} = $value;
        }
        $order->save();
        return $order;
    }

    public function update(Model $order, ModelDto $dto): Model
    {
        $order->update($dto->toArray());
        return $order;
    }

    public function find(int $identifier, $key = 'id'): ?Order
    {
        return Order::where($key, $identifier)->first();
    }

    public function delete(Model $order): bool
    {
        return $order->delete();
    }

    public function createMany(ModelDto $dto)
    {
        $products = $this->productRepository->findMany($dto);

        $products->each(function($product) use($dto){
            $product->lockForUpdate();
            $product->sell($dto->quantityOf($product->getKey()));
            $dto->push($product);
        });

        OrderItem::insert($dto->order_items);

    }

}
