<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'look_builder_product_id',
        'cart_id',
        'quantity',
        'total_price',
    ];
    public function lookBuilderProduct()
    {
        return $this->belongsTo(LookBuilderProduct::class);
    }
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
