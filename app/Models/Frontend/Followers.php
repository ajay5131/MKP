<?php

namespace App\Models\Frontend;
use Illuminate\Database\Eloquent\Model;


class Followers extends Model
{
	protected $table = 'profile_followers';
    
	public $timestamps = true;

	protected $dates = ['created_at', 'updated_at'];
	protected $guarded = [];

}
