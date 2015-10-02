<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $table = 'sellers';
	
	public function category()
	{
		return $this->belongsTo('App\Category');
	}
}
