<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'name',
        'description',
        'look_builder_product_id',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function options()
    {
        return $this->hasMany(Option::class);
    }
    public function lookBuilderProduct()
    {
        return $this->belongsTo(LookBuilderProduct::class);
    }
    public function customProduct()
    {
        return $this->belongsTo(CustomProduct::class);
    }
}
