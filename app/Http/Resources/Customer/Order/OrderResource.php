<?php

namespace App\Http\Resources\Customer\Order;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'order_id' => $this->id,
            'total_amount' => $this->net_price,
            'status' => $this->status->name,
        ];
    }
}
