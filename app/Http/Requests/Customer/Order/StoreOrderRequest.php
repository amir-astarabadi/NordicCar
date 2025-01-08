<?php

namespace App\Http\Requests\Customer\Order;

use App\DBRepository\Concretes\Order\OrderPlacementDto;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\OrderProductsRule;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->id() === $this->customer_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_id' => ['required', 'integer'],
            'products' => ['required', 'array', new OrderProductsRule],
        ];
    }

    public function getDto()
    {
        $dto = resolve(OrderPlacementDto::class);

        $dto->customerId = $this->customer_id;
        $dto->products  = $this->products;

        return $dto;
    }
}
