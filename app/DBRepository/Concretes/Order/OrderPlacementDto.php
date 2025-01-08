<?php

namespace App\DBRepository\Concretes\Order;

use App\DBRepository\Concretes\OrderItem\OrderItemsDto;
use App\DBRepository\Contracts\ModelDto;
use Illuminate\Support\Arr;

class OrderPlacementDto extends ModelDto
{
    protected ?int $customerId;
    protected ?array $products;
    protected ?OrderDto $orderDto;
    protected ?OrderItemsDto $orderItemsDto;
    
    public function __construct()
    {
        $this->orderDto = resolve(OrderDto::class);    
        $this->orderItemsDto = resolve(OrderItemsDto::class);    
    }

    public function getOrderDto()
    {
        $this->orderDto->customer_id = $this->customerId;
    
        return $this->orderDto;
    }

    public function getOrderItemsDto()
    {
        $this->orderItemsDto->products = Arr::keyBy($this->products, 'id');

        return $this->orderItemsDto;
    }
}
