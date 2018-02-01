<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Order;

class Timeslot extends Model
{
    // Attributes that can be assigned through a create statement.
    protected $fillable = [
    	'day',
    	'start_time',
    	'end_time',
    	'num_available_slots'
    ];

    public function orders() {
    	return $this->hasMany('App\Order');
    }

    protected $appends = ['num_filled_slots'];

    public function getNumFilledSlotsAttribute() {
    	return $this->orders()->count();
    }

    // protected $dates = [
    // 	'day',
    // 	'start_time',
    // 	'end_time'
    // ];
    // protected $dateFormat = 'Y-m-d';
}
