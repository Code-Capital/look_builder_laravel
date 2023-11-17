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
        'product_id',
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
    public function lookBuilderProducts()
    {
        return $this->belongsTo(LookBuilderProduct::class);
    }
}
