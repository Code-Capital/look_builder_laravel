<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductLayerImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'custom_product_id',
        'fabric_id',
        'image',
    ];
    public function customProduct()
    {
        return $this->belongsTo(CustomProduct::class);
    }
    public function fabric()
    {
        return $this->belongsTo(Fabric::class);
    }
}
