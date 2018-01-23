<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
	protected $fillable = [
		'title'
	];

    public function orders() {
    	return $this->hasMany('App\Order');
    }
}
