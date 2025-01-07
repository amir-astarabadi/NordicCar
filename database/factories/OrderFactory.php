<?php

namespace Database\Factories;

use App\Enums\OrderStatusEnum;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => User::factory(),
            'status' => OrderStatusEnum::PENDING,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Order $order) {
            OrderItem::factory(random_int(1, 2))->onOrder($order)->create();
            $order->updateNetPrice();
        });
    }

    public function forCustomer(User $customer)
    {
        return $this->state(['customer_id' => $customer->getKey()]);
    }
}
