<?php
namespace App;

class Recipe extends Imageable
{
    protected $guarded = [];

    public function types()
    {
        return $this->morphToMany('App\FoodType', 'typeable');
    }
}
