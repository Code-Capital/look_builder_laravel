<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomSuit extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'name',
        'jacket_id',
        'pant_id',
        'waistcoat_id',
    ];
    public function jacket()
    {
        return $this->belongsTo(CustomProduct::class, 'jacket_id');
    }
    public function pant()
    {
        return $this->belongsTo(CustomProduct::class, 'pant_id');
    }
    public function waistcoat()
    {
        return $this->belongsTo(CustomProduct::class, 'waistcoat_id');
    }
}
