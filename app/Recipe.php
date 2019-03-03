<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $guarded = [];
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
