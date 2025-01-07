<?php

namespace App\Http\Resources\Customer\Order;

use App\Http\Resources\Contracts\CollectionResource;
use Illuminate\Http\Request;

class OrderResourceCollection extends CollectionResource
{
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
