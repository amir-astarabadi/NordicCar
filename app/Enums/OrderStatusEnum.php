<?php 

namespace App\Enums;

enum OrderStatusEnum: int
{
    case PENDING = 1;

    case CANCELED = 2;

    case SHIPED = 3;

    case DELIVERED = 4;
}