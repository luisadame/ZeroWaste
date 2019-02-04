<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = ['name', 'user_id'];
    protected $casts = [
        'user_id' => 'integer'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
