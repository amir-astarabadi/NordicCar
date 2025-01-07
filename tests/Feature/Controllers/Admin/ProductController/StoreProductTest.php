<?php

namespace Tests\Feature\Controllers\Admin\ProductController;

use App\Models\Product;
use Tests\TestCase;

class StoreProductTest extends TestCase
{
    private array $requestData = [];

    public function setUp():void{
        parent::setUp();
        $this->loginAsAdmin();
        $this->requestData = Product::factory()->make()->toArray();
    }
 
    public function test_admin_can_store_product(): void
    {
        $response = $this->postJson(route('api.admin.products.store'), $this->requestData);

        $response->assertCreated();

        $this->assertDatabaseCount('products', 1);

        $this->assertDatabaseHas('products', $this->requestData);
    }
}
