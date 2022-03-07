<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
	protected $table = 'interests';
    protected $fillable = [
         'title', 'image'
    ];
    public $timestamps = false;

}
