<?php

namespace App\Models\Frontend;
use Illuminate\Database\Eloquent\Model;


class KeyPeoples extends Model
{
	protected $table = 'keypeoples';
    
	public $timestamps = true;

	protected $dates = ['created_at', 'updated_at'];
	protected $guarded = [];



	public function usersProfile() {
        return $this->belongsTo('App\Models\Frontend\UsersProfile', 'receiver_id', 'users_id');
    }

    public function getReceiverInfo($field = '') {
		$usersProfile = $this->usersProfile()->where('profile_id', 1)->first();
		
		if(null === $usersProfile){
			$usersProfile = $this->usersProfile()->where('profile_id', 1)->first();
		}
        if(null !== $usersProfile){
			if (!empty($field)) {
				return $usersProfile->$field;
			} else {
				return $usersProfile;
			}
		}
    }
	
}
