<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'name',
    ];
    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }
    public function fabric()
    {
        return $this->belongsTo(Fabric::class);
    }
}
