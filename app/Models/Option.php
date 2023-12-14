<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'name',
        'attribute_id'
    ];
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
