<?php

namespace App\DBRepository\Concretes\Product;

use App\DBRepository\Contracts\ModelDto;

class ProductIndexDto extends ModelDto
{
    protected ?int $page = 1;
    protected ?int $perpage = 20;
}
