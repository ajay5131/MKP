<?php

namespace App\Models\Frontend;
use Illuminate\Database\Eloquent\Model;


class Visible extends Model
{
	protected $table = 'visible';
    
	public $timestamps = false;

	protected $dates = ['created_at', 'updated_at'];
	protected $guarded = [];

}
