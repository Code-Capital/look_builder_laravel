<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suit extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'title',
        'description',
        'product_image',
        'shirt_id',
        'trouser_id'
    ];
    public function shirt()
    {
        return $this->belongsTo(LookBuilderProduct::class, 'shirt_id');
    }

    public function trouser()
    {
        return $this->belongsTo(LookBuilderProduct::class, 'trouser_id');
    }
}
