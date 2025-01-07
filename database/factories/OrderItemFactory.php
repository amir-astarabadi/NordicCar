<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'product_id' => $product = Product::factory()->create(),
            'quantity' => $quantity = random_int(1, $product->stock),
            'unit_price' => $product->price,
            'net_price' => $quantity * $product->price,
        ];
    }

    public function onOrder(Order $order)
    {
        return $this->state([
            'order_id' => $order->getKey()
        ]);
    }
}
