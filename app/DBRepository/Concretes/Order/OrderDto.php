<?php

namespace App\DBRepository\Concretes\Order;

use App\DBRepository\Contracts\ModelDto;
use App\Enums\OrderStatusEnum;

class OrderDto extends ModelDto
{
    protected ?int $customer_id;
    protected ?OrderStatusEnum $status = OrderStatusEnum::PENDING;
}
