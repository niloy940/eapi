<?php

namespace App\Model;

use App\Model\Review;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
