<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Shop extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'region_id',
        'genre_id',
        'detail',
        'image_path'
    ];

    public function favorite()
    {
        return $this->hasone(Favorite::class);
    }
    public function reservation()
    {
        return $this->hasmany(Reservation::class);
    }
    public function admin()
    {
        return $this->hasone(Admin::class);
    }
    // public function region()
    // {
    //     return $this->hasone(Region::class);
    // }
    public function category()
    {
        return $this->belongsTo(Genre::class);
    }
    // public function region()
    // {
    //     return $this->hasone(Region::class);
    // }

}
