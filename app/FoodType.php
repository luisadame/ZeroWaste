<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodType extends Model
{
    public function food()
    {
        return $this->hasMany('App\Food', 'food_food_type');
    }
}
