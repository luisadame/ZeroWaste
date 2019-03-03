<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    /**
     * Relationship with its images.
     *
     * @return void
     */
    public function images()
    {
        $this->morphMany('App\Recipe', 'imageable');
    }
}
