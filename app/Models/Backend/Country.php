<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
	protected $table = 'countries';
    protected $fillable = [
        'title', 'title_fr'
    ];
    public $timestamps = true;
    protected $dates = ['created_at', 'updated_at'];

    public function states() {
        // return $this->hasMany('App\State', 'country_id', 'id');
    }

    public function state(){

        return $this->hasMany(State::class);
    }

    public function stateList(){

        return $this->state()->select('id','country_id','title','title_fr');
    }
}
