<?php
namespace App;

class Recipe extends Imageable
{
    protected $guarded = [];

    public function time()
    {
        $hours = floor($this->cooking_time / 60);
        $minutes = $this->cooking_time % 60;
        $timeTotring = "";

        if ($hours > 0) {
            $timeTotring = "{$hours} " . str_plural('hour', $hours);
        }

        if ($minutes > 0 && $timeTotring !== "") {
            $timeTotring .= " and {$minutes} " . str_plural('minute', $minutes);
        } else {
            $timeTotring = "{$minutes} " . str_plural('minute', $minutes);
        }

        return $timeTotring;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function types()
    {
        return $this->morphToMany('App\FoodType', 'typeable');
    }
}
