<?php

namespace App\Http\Requests\Admin\Product;

use App\DBRepository\Concretes\Product\ProductIndexDto;
use Illuminate\Foundation\Http\FormRequest;

class IndexProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "perpage" => ['integer', 'min:1', 'max:20'],
            "page" => ['integer', 'min:1'],
        ];
    }

    public function getDto():ProductIndexDto
    {
        $dto = resolve(ProductIndexDto::class);

        $dto->page = $this->get('page', $dto->page);
        $dto->perpage = $this->get('perpage', $dto->perpage);

        return $dto;
    }
}
