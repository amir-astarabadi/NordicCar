<?php

namespace Tests\Feature\Controllers\Admin\CustomerController;

use Illuminate\Testing\Fluent\AssertableJson;
use App\Models\User;
use Tests\TestCase;

class ShowCustomerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->loginAsAdmin();

        $this->customer = User::factory()->create();
    }

    public function test_admin_can_view_customer(): void
    {
        $response = $this->getJson(route('api.admin.customers.show', $this->customer->getKey()));

        $response->assertOk();

        $response->assertJson(function (AssertableJson $response) {
            return $response
                ->where('data.name', $this->customer->name)
                ->where('data.email', $this->customer->email)
                ->etc();
        });
    }
}
