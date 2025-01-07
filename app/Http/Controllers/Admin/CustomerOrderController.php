<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Customer\Order\OrderResourceCollection;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerOrderController extends Controller
{

    public function index(User $customer)
    {
        return OrderResourceCollection::make($customer->orders);
    }
}
