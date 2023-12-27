<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'look_builder_product_id',
        'custom_product_id',
        'size',
        'quantity',
        'fabric_id',
        'price',
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function lookBuilderProduct()
    {
        return $this->belongsTo(LookBuilderProduct::class, 'look_builder_product_id');
    }
    public function customProduct()
    {
        return $this->belongsTo(CustomProduct::class, 'custom_product_id');
    }
    public function orderProductOptions()
    {
        return $this->hasMany(OrderProductOption::class);
    }
}
