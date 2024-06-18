<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'region',
    ];

    // public function shop()
    // {
    //     return $this->hasmany(Shop::class);
    // }
    public function category()
    {
        return $this->belongsTo(Shop::class);
    }
}
