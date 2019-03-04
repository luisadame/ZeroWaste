<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $visible = ['id', 'url'];

    public function imageable()
    {
        $this->morphTo();
    }
}
