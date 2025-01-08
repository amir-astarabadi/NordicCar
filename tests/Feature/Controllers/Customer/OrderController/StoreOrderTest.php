<?php

namespace Tests\Feature\Controllers\Customer\OrderController;

use App\Enums\OrderStatusEnum;
use App\Models\Order;
use App\Models\Product;
use App\Notifications\CustomerOrderStatsuUpdatedNotification;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Notification;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class StoreOrderTest extends TestCase
{

    private array $requestData = [];

    private array $initialStoks = [];

    private Collection $products;

    public function setUp(): void
    {
        parent::setUp();

        $this->loginAsCustomer();

        $this->products = Product::factory(2)->create();

        $this->initialStoks = $this->products->pluck('stock', 'id')->toArray();

        $this->requestData = [
            'customer_id' => $this->customer->getKey(),
            'products' => $this->products->map(fn($p) => ['id' => $p->getKey(), 'quantity' => random_int(1, $p->stock)])->toArray(),
        ];
    }

    public function test_customer_can_place_order(): void
    {
        // $this->withoutExceptionHandling();
        $response = $this->postJson(route('api.customer.orders.store'), $this->requestData);

        $response->assertCreated();

        $this->assertTrue(true);


        $order = $this->customer->orders->first();


        $response->assertJson(function (AssertableJson $response) use ($order) {
            return $response
                ->where('data.order_id', $order->getKey())
                ->where('data.total_amount', $order->net_price)
                ->etc();
        });

        foreach ($this->products as $product) {

            $initialStock = $this->initialStoks[$product->getKey()];
            $orderItemQuantity = $order->items->where('product_id', '=', $product->getKey())->first()->quantity;

            $currentStock = $product->refresh()->stock;

            $this->assertEquals($currentStock, ($initialStock - $orderItemQuantity));
        }
    }

    public function update_order_status_send_notification_to_customer()
    {
        $order = Order::factory()->create();

        $order->update(['status' => OrderStatusEnum::CONFIRMED]);

        Notification::assertSentTo($order->customer, CustomerOrderStatsuUpdatedNotification::class);
    }
}
