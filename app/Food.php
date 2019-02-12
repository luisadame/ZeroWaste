<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'food';

    public function types()
    {
        return $this->belongsToMany('App\FoodType', 'food_food_type');
    }

    public function inventories()
    {
        return $this->belongsToMany('App\Inventory', 'inventory_food');
    }
}
