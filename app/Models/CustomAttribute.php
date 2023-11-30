<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomAttribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'name',
        'description',
        'custom_product_id',
    ];
    public function customProduct()
    {
        return $this->belongsTo(CustomProduct::class);
    }
    public function customOptions()
    {
        return $this->hasMany(CustomOption::class);
    }
}
