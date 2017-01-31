<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timeslot extends Model
{
    // Attributes that can be assigned through a create statement.
    protected $fillable = [
    	'day_of_week',
    	'class_time',
    	'num_slots'
    ];
}
