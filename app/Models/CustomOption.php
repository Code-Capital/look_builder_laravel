<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomOption extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'name',
        'description',
        'price',
        'image',
        'custom_attribute_id',
        'fabric_id',
    ];
    public function customAttribute()
    {
        return $this->belongsTo(CustomAttribute::class);
    }
    public function cartProductOption()
    {
        return $this->hasMany(CartProductOption::class);
    }
    public function fabric()
    {
        return $this->belongsTo(Fabric::class);
    }
    public function customOptionImages()
    {
        return $this->hasMany(CustomOptionImage::class);
    }
}
