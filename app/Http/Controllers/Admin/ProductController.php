<?php

namespace App\Http\Controllers\Admin;

use App\DBRepository\Concretes\Product\ProductRepository;
use App\Http\Resources\Product\ProductResourceCollection;
use App\Http\Requests\Admin\Product\StoreProductRequest;
use App\Http\Requests\Admin\Product\IndexProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function __construct(private ProductRepository $productRepository){}

    public function index(IndexProductRequest $request)
    {
        $searchDto = $request->getDto();

        $products = $this->productRepository->paginate($searchDto->page, $searchDto->perpage);

        return ProductResourceCollection::make($products);
    }

    public function store(StoreProductRequest $request)
    {
        $product = $this->productRepository->create($request->getDto());

        return ProductResource::make($product);
    }
}
