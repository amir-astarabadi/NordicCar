<?php

namespace App\Http\Controllers\Customer;

use App\DBRepository\Concretes\Order\OrderRepository;
use App\Http\Requests\Customer\Order\StoreOrderRequest;
use App\Http\Resources\Customer\Order\OrderResource;
use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function __construct(private OrderRepository $orderRepository){}

    public function store(StoreOrderRequest $request)
    {
        $order = $this->orderRepository->placeOrder($request->getDto());

        return OrderResource::make($order);
    }

    public function index(Order $order)
    {
        return OrderResource::make($order);
    }

}
