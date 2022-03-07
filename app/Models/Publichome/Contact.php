<?php

namespace App\Models\Publichome;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $table = 'contact_us';
    protected $fillable = [
        'fname', 'email', 'type', 'message', 'country_code', 'contact'
    ];
    public $timestamps = true;
    protected $dates = ['created_at'];

}
