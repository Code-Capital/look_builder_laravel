<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'title',
    ];
    public function customAttributes()
    {
        return $this->hasMany(CustomAttribute::class);
    }
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
    public function productLayerImages()
    {
        return $this->hasMany(ProductLayerImage::class);
    }
}
