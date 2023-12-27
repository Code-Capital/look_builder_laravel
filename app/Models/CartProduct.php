<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'look_builder_product_id',
        'custom_product_id',
        'cart_id',
        'quantity',
        'size',
        'total_price',
        'fabric_id',
    ];
    public function lookBuilderProduct()
    {
        return $this->belongsTo(LookBuilderProduct::class, 'look_builder_product_id');
    }
    public function customProduct()
    {
        return $this->belongsTo(CustomProduct::class, 'custom_product_id');
    }
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
    public function cartProductOptions()
    {
        return $this->hasMany(CartProductOption::class);
    }
    public function fabric()
    {
        return $this->belongsTo(Fabric::class);
    }
}
