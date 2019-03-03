<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'food';

    /**
     * Attributes that should be mutated to dates
     *
     * @var array
     */
    protected $dates = [
        'expiration_date'
    ];

    /**
     * Get a lozalized string formatted with the expiration date
     */
    public function expirationString()
    {
        $tense = $this->expiration_date->isPast() ? trans('dates.expired_on') : trans('dates.expires_on');
        return $tense . ' ' . $this->expiration_date->toDayDateTimeString();
    }

    /**
     * Get a css class to visually inform the user how close is
     * an item to be expired
     *
     * @return void
     */
    public function expirationProximity()
    {
        $daysUntilExpiration = now()->diffInDays($this->expiration_date, false);
        if ($daysUntilExpiration < 10) {
            if ($daysUntilExpiration < 0) {
                return 'card--danger';
            }
            return 'card--warning';
        }
        return '';
    }

    /**
     * Relationship with its type
     *
     * @return void
     */
    public function types()
    {
        return $this->belongsToMany('App\FoodType', 'food_food_type');
    }

    /**
     * Relationship with the inventory
     *
     * @return void
     */
    public function inventory()
    {
        return $this->belongsTo('App\Inventory');
    }
}
