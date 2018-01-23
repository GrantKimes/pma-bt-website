<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    // protected $dates = [
    // 	'day',
    // 	'start_time',
    // 	'end_time'
    // ];
    // protected $dateFormat = 'Y-m-d';
}
