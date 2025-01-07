<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    use DatabaseTransactions;

    protected ?User $admin = null;

    protected ?User $customer = null;

    protected function loginAsAdmin()
    {
        $this->admin = User::factory()->create();
        Sanctum::actingAs($this->admin, ['view-dashboard', 'manage-resources']);
    }

    protected function loginAsCustomer()
    {
        $this->customer = User::factory()->create();
        Sanctum::actingAs($this->customer, ['view-dashboard']);
    }
}
