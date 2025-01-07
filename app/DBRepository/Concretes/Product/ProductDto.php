<?php

namespace App\DBRepository\Concretes\Product;

use App\DBRepository\Contracts\ModelDto;

class ProductDto extends ModelDto
{
    protected ?string $name = '';
    protected ?int $price = 0;
    protected ?int $stock = 0;
}
