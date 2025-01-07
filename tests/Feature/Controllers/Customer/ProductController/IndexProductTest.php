<?php

namespace Tests\Feature\Controllers\Customer\ProductController;

use App\Models\Product;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class IndexProductTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Product::factory(2)->create();
    }

    public function test_customer_can_index_products(): void
    {
        $response = $this->getJson(route('api.customer.products.index'));

        $response->assertOk();

        $response->assertJson(function (AssertableJson $response) {
            return $response->count('data', 2)
                ->where('meta_data.current_page', 1)
                ->where('meta_data.total', Product::count())
                ->etc();
        });
    }

    public function test_customer_can_change_paginated_products_size(): void
    {
        $response = $this->getJson(route('api.customer.products.index', ['perpage' => 1, 'page' => 1]));

        $response->assertJson(function (AssertableJson $response) {
            return $response->count('data', 1)
                ->where('meta_data.current_page', 1)
                ->where('meta_data.total', Product::count())
                ->etc();
        });


        $response = $this->getJson(route('api.customer.products.index', ['perpage' => 1, 'page' => 2]));

        $response->assertJson(function (AssertableJson $response) {
            return $response->count('data', 1)
                ->where('meta_data.current_page', 2)
                ->where('meta_data.total', Product::count())
                ->etc();
        });
    }
}
