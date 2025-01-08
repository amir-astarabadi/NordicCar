<?php

namespace App\DBRepository\Concretes\OrderItem;

use App\DBRepository\Contracts\ModelDto;
use App\Models\Product;

class OrderItemsDto extends ModelDto
{
    protected ?array $products = [];
    protected ?int $order_id;
    protected ?array $order_items = [];

    public function getProductIds():array
    {
        return array_keys($this->products);
    }

    public function quantityOf(int $productId):int
    {
        return $this->products[$productId]['quantity'];
    }

    public function push(Product $product):void 
    {
        $this->order_items[] = [
            'order_id' => $this->order_id,
            'product_id' => $product->getKey(),
            'quantity' => $quantity = $this->quantityOf($product->getKey()),
            'unit_price' => $product->price,
            'net_price' => $product->price * $quantity,
            'created_at' => now()->toDateTimeString(),
        ];
    }
}
