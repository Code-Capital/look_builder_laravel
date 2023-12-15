<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fabric extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'name',
        'image',
        'price',
        'composition',
        'weight',
        'season',
        'woven_by',
        'fabric_code',
    ];
    public function customProducts()
    {
        return $this->hasMany(CustomProduct::class);
    }
    public function productLayerImages()
    {
        return $this->hasMany(ProductLayerImage::class);
    }
}
