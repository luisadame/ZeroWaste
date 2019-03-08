<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodType extends Model
{
    public function recipes()
    {
        return $this->morphedByMany('App\Recipe', 'typeable');
    }

    public function food()
    {
        return $this->morphedByMany('App\Food', 'typeable');
    }
}
