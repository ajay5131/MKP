<?php

namespace App\Models\Publichome;

use Illuminate\Database\Eloquent\Model;

class ServicesDetail extends Model
{
	protected $table = 'home_services_detail';
    protected $fillable = [
        'language_id', 'home_services_id', 'title', 'description'
    ];
    public $timestamps = false;

}
