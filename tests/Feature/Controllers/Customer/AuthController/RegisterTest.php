<?php

namespace Tests\Feature\Controllers\Customer\ProductController;

use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Support\Arr;
use App\Models\User;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    private array $requestData = [];

    public function setUp(): void
    {
        parent::setUp();

        $this->requestData = Arr::only(User::factory()->make()->toArray(), ['name', 'email']);
        $this->requestData['password_confirmation'] = $this->requestData['password'] = 'password';
    }

    public function test_customer_can_register(): void
    {
        $response = $this->postJson(route('api.customer.auth.register'), $this->requestData);

        $response->assertCreated();

        $this->assertDatabaseHas('users', Arr::only($this->requestData, ['name', 'email']));

        $response->assertJson(function (AssertableJson $response) {
            return $response->has('data.auth_token')
                ->where('data.name', $this->requestData['name'])
                ->where('data.email', $this->requestData['email'])
                ->etc();
        });
    }
}
