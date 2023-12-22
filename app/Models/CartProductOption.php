<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProductOption extends Model
{
    use HasFactory;
    protected $fillable = [
        'cart_product_id',
        'custom_option_id',
        'custom_product_id',
    ];
    public function cartProduct()
    {
        return $this->belongsTo(CartProduct::class, 'cart_product_id');
    }
    public function customOption()
    {
        return $this->belongsTo(CustomOption::class, 'custom_option_id');
    }
}
