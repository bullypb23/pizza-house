<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
