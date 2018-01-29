<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use App\Events\OrderSaving;

class Order extends Model
{
	protected $attributes = [
		'comment' => '',
	];

    // Attributes which are mass assignable
    protected $fillable = [
    	'recipient_name',
    	'sender_name',
    	'sender_email', 
    	'location',
    	'comment',
    	'timeslot_id',
    	'song_id'
    ];

    public function timeslot() {
    	return $this->belongsTo('App\Timeslot');
    }

    public function song() {
    	return $this->belongsTo('App\Song');
    }
	// TODO: Use soft deletion
	// use SoftDeletes;
	// protected $dates = ['deleted_at'];

	protected $dispatchesEvents = [
		'saving' => OrderSaving::class
	];
}
