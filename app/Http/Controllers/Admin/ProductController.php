<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Http\Requests\Admin\Product\StoreProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\DBRepository\Contracts\CRUDInterface;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function __construct(private CRUDInterface $productRepository){}

    public function index()
    {
        //
    }

    public function store(StoreProductRequest $request)
    {
        $product = $this->productRepository->create($request->getDto());

        return ProductResource::make($product);
    }

    public function show(Product $product)
    {
        //
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
}
