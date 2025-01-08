<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'stock',
    ];

    public static function getPrimaryKeyName()
    {
        return (new static())->getKeyName();
    }

    public function sell(int $amount)
    {
        $this->update(['stock' => $this->stock - $amount]);
    }
}
