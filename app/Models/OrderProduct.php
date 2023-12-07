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
        'size',
        'quantity',
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function lookBuilderProduct()
    {
        return $this->belongsTo(LookBuilderProduct::class);
    }
}
