<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Contracts\CollectionResource;
use Illuminate\Http\Request;

class ProductResourceCollection extends CollectionResource
{
    
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
