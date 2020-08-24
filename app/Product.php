<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class)->withPivot('price');
    }

    public function orderItems()
    {
        return $this->belongsToMany(OrderItem::class);
    }
}
