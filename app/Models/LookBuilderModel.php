<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LookBuilderModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image',
        'layer_image',
        'hand_image',
    ];
}
