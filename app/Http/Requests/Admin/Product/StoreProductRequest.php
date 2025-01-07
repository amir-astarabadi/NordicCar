<?php

namespace App\Http\Requests\Admin\Product;

use App\DBRepository\Concretes\Product\ProductDto;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "name" => ['required', 'string', 'max:250', 'min:3'],
            "price" => ['required', 'integer', 'min:100', 'max:100000000'],
            "stock" => ['required', 'integer', 'min:1', 'max:100000'],
        ];
    }

    public function getDto():ProductDto
    {
        $dto = resolve(ProductDto::class);

        $dto->name = $this->name;
        $dto->price = $this->price;
        $dto->stock = $this->stock;

        return $dto;
    }
}
