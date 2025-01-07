<?php

namespace App\Http\Controllers\Customer;

use App\Http\Resources\Customer\ProfileResource;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    
    public function __invoke()
    {
        return ProfileResource::make(auth()->user());
    }
}
