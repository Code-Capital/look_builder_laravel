<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'name',
        'image',
    ];
    public function lookBuilderProducts()
    {
        return $this->hasMany(LookBuilderProduct::class);
    }
    public function customProducts()
    {
        return $this->hasMany(CustomProduct::class);
    }
    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }
}
