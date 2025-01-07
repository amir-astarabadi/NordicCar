<?php

namespace Tests\Feature\Controllers\Admin\CustomerOrderController;

use Illuminate\Testing\Fluent\AssertableJson;
use App\Models\Order;
use App\Models\User;
use Tests\TestCase;

class ShowCustomerOrdersTest extends TestCase
{
    private Order $order;

    public function setUp(): void
    {
        parent::setUp();

        $this->loginAsAdmin();

        $this->customer = User::factory()->create();

        $this->order = Order::factory()->forCustomer($this->customer)->create();
    }

    public function test_admin_can_view_customer_orders(): void
    {
        $response = $this->getJson(route('api.admin.customers.orders.index', $this->customer->getKey()));

        $response->assertOk();

        $response->assertJson(function (AssertableJson $response) {
            return $response
                ->count('data', $this->customer->orders()->count())
                ->where('data.0.net_price', $this->order->net_price)
                ->etc();
        });
    }
}
