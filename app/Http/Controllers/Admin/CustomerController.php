<?php

namespace App\Http\Controllers\Admin;

use App\DBRepository\Concretes\Customer\CustomerRepository;
use App\Http\Resources\Customer\CustomerResource;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function __construct(private CustomerRepository $customerRepository){}

    public function show(string $customer)
    {
        $customer = $this->customerRepository->find($customer);

        return CustomerResource::make($customer);
    }
}
