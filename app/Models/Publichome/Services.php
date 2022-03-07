<?php

namespace App\Models\Publichome;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
	protected $table = 'home_services';
    protected $fillable = [
         'description', 'description_fr', 'title', 'title_fr'
    ];
    public $timestamps = true;
    protected $dates = ['updated_at'];

}
