<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomOptionImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'fabric_id',
        'custom_option_id',
        'layer_image',
    ];
    public function fabric()
    {
        return $this->belongsTo(Fabric::class);
    }
    public function customOption()
    {
        return $this->belongsTo(CustomOption::class);
    }
}
