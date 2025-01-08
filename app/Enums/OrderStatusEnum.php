<?php 

namespace App\Enums;

enum OrderStatusEnum: int
{
    case PENDING = 1;
    
    case CONFIRMED = 2;

    case CANCELED = 3;

    case SHIIPED = 4;

    case DELIVERED = 5;
}