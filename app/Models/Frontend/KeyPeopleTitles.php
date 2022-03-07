<?php

namespace App\Models\Frontend;
use Illuminate\Database\Eloquent\Model;


class KeyPeopleTitles extends Model
{
	protected $table = 'keypeople_titles';
    
	public $timestamps = true;

	protected $dates = ['created_at', 'updated_at'];
	protected $guarded = [];
}
