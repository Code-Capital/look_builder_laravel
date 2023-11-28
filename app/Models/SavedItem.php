<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'user_id',
        'look_builder_product_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function lookBuilderProduct()
    {
        return $this->belongsTo(LookBuilderProduct::class);
    }
}
