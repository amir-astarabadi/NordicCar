<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\Customer\CustomerResource;
use App\Http\Controllers\Controller;
use App\Models\User;

class CustomerController extends Controller
{
    public function show(User $customer)
    {
        return CustomerResource::make($customer);
    }
}
