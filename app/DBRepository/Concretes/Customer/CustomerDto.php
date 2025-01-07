<?php

namespace App\DBRepository\Concretes\Customer;

use App\DBRepository\Contracts\ModelDto;

class CustomerDto extends ModelDto
{
    protected ?string $name = '';
    protected ?string $email = '';
    protected ?string $password = '';
}
