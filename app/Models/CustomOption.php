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
        'image',
        'custom_attribute_id'
    ];
    public function customAttribute()
    {
        return $this->belongsTo(CustomAttribute::class);
    }
}
