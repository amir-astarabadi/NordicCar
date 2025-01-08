<?php

namespace App\DBRepository\Concretes\Order;

use App\DBRepository\Concretes\OrderItem\OrderItemRepository;
use App\DBRepository\Contracts\CRUDInterface;
use App\DBRepository\Contracts\ModelDto;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class OrderRepository implements CRUDInterface
{

    public function __construct(private OrderItemRepository $orderItemRepository)
    {}
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

    public function placeOrder(OrderPlacementDto $dto):Order
    {
        $order = DB::transaction(function()use($dto){
            $order = $this->create($dto->getOrderDto());
            
            $orderImtesDto = $dto->getOrderItemsDto();
            $orderImtesDto->order_id = $order->getKey();
            $this->orderItemRepository->createMany($orderImtesDto);
        
            $order->updateNetPrice();

            return $order;
        });

        return $order;
    }
}
