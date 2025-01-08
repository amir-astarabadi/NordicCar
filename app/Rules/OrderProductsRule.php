<?php

namespace App\Rules;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Arr;

class OrderProductsRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $products = $this->getProductIds($value);

        $requestedProducts = Product::whereIn('id', array_keys($products))->get();

        if ($requestedProducts->count() < count($products)) {
            $fail(trans('validation.place_order_mismatch_products'));
        }

        foreach ($requestedProducts as $product) {
            if ($product->stock < $products[$product->getKey()])
                $fail(trans('validation.place_order_mismatch_product_stock', ['product' => $product->name, 'stock' => $products[$product->getKey()]]));
        }
    }

    private function getProductIds(array $value): array
    {
        return Arr::pluck($value, 'quantity', 'id');
    }
}
