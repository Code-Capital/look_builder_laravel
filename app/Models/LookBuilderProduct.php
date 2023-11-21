<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LookBuilderProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'title',
        'product_image',
        'layer_image',
        'color',
        'size',
        'price',
        'description',
        'category_id',
        'fabric_id',
    ];
    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function fabric()
    {
        return $this->belongsTo(Fabric::class);
    }
}
