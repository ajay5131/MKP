<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\State;

class Language extends Model
{
	protected $table = 'languages';
    
    public $timestamps = true;
    protected $dates = ['created_at', 'updated_at'];

}
