<?php

namespace App\Models\Frontend;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\City;
use App\Models\Backend\Country;
use App\Models\Backend\State;


class UsersProfile extends Model
{
	protected $table = 'users_profiles';
    public $timestamps = false;

	protected $appends = ['image_path'];


	public function getImagePathAttribute(){
		return asset('/').'uploads/profile_picture/'.$this->profile_pic;
    }

    /**
    * Accessor for Age.
    */
    public function age() {
        return Carbon::parse($this->attributes['dob'])->age;
    }

    public function country() {
        return $this->belongsTo('App\Models\Backend\Country', 'country_id', 'id');
    }

    public function getCountry($field = '') {
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

    public function city() {
        return $this->belongsTo('App\Models\Backend\City', 'city_id', 'id');
    }

    public function getCity($field = '') {
		$city = $this->city()->first();
		if(null === $city){
			$city = $this->city()->first();
		}
        if(null !== $city){
			if (!empty($field)) {
				return $city->$field;
			} else {
				return $city;
			}
		}
    }

    public function state() {
        return $this->belongsTo('App\Models\Backend\State', 'state_id', 'id');
    }

    public function getState($field = '')
    {
		$state = $this->state()->first();
		if(null === $state){
			$state = $this->state()->first();
		}
        if(null !== $state){
			if (!empty($field)) {
				return $state->$field;
			} else {
				return $state;
			}
		}
    }
    
	public function profiles() {
        return $this->belongsTo('App\Models\Frontend\Profiles', 'profile_id', 'id');
    }

    public function getProfile($field = '')
    {
		$profiles = $this->profiles()->first();
		if(null === $profiles){
			$profiles = $this->profiles()->first();
		}
        if(null !== $profiles){
			if (!empty($field)) {
				return $profiles->$field;
			} else {
				return $profiles;
			}
		}
    }

}
