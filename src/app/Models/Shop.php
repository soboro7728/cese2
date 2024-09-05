<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Shop extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'region',
        'genre',
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
    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

}
