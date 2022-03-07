<?php

namespace App\Models\Frontend;
use Illuminate\Database\Eloquent\Model;


class KeylistTitles extends Model
{
	protected $table = 'keylist_titles';
    
	public $timestamps = true;

	protected $dates = ['created_at', 'updated_at'];
	protected $guarded = [];
}
