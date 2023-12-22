<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProductOption extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_product_id',
        'custom_option_id',
        'custom_product_id'
    ];
    public function option()
    {
        return $this->belongsTo(CustomOption::class, 'custom_option_id');
    }
}
