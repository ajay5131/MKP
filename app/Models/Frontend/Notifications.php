<?php

namespace App\Models\Frontend;
use Illuminate\Database\Eloquent\Model;


class Notifications extends Model
{
	protected $table = 'notification';
    
	public $timestamps = true;

	protected $dates = ['created_at', 'updated_at'];
	protected $guarded = [];
}
