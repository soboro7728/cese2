<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shoptest extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'region',
        'genre',
        'detail',
        'image_path'
    ];
}
