<?php

namespace App\Http\Controllers\Customer;

use App\Http\Resources\Product\ProductResourceCollection;
use App\DBRepository\Concretes\Product\ProductRepository;
use App\Http\Requests\Admin\Product\IndexProductRequest;
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
}
