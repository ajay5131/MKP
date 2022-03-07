<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
	protected $table = 'state';
    protected $fillable = [
        'title', 'country_id', 'title_fr'
    ];
    public $timestamps = true;
    protected $dates = ['created_at', 'updated_at'];

    public function country()
    {
        return $this->belongsTo('App\Models\Backend\Country', 'country_id', 'id');
    }

    public function getCountry($field = '')
    {
		$country = $this->country()->first();
		if(null === $country){
			$country = $this->country()->first();
		}
        if(null !== $country){
			if (!empty($field)) {
				return $country->$field;
			} else {
				return $country;
			}
		}
    }

    public function cities(){

        return $this->hasMany(City::class);
    }

    public function citiesList(){

        return $this->cities()->select('id','state_id','title','title_fr');
    }



}
