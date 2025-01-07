<?php

namespace App\Http\Controllers\Customer;

use App\DBRepository\Concretes\Customer\CustomerRepository;
use App\Http\Requests\Customer\Auth\RegisterRequest;
use App\Http\Resources\Auth\RegisterResource;
use App\Utilities\Authentication\AuthUtility;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function __construct(private CustomerRepository $customerRepository, private AuthUtility $authUtility)
    {
        
    }
    public function register(RegisterRequest $request)
    {
        $customer = $this->customerRepository->create($request->getDto());

        $this->authUtility->login($customer);

        return RegisterResource::make($customer);
    }
}
