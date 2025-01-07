<?php

namespace Tests\Feature\Controllers\Customer\ProductController;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CustomerProfileTest extends TestCase
{    
    public function test_customer_can_view_dashboard(): void
    {
        $this->loginAsCustomer();

        $response = $this->getJson(route('api.customer.dashboard.show'));

        $response->assertOk();

        $response->assertJson(function (AssertableJson $response) {
            return $response
                ->where('data.name', $this->customer->name)
                ->where('data.email', $this->customer->email)
                ->etc();
        });
    }


    public function test_guest_customer_can_not_view_dashboard(): void
    {
        $response = $this->getJson(route('api.customer.dashboard.show'));

        $response->assertUnauthorized();
    }
}
