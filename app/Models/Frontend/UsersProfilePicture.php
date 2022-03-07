<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class UsersProfilePicture extends Model
{
	protected $table = 'users_profiles_picture';
    public $timestamps = true;
	protected $dates = ['created_at'];
	
	const UPDATED_AT = null;

	protected $guarded = [];

    protected $appends = ['image_path'];

    public function getImagePathAttribute(){
    	return asset('/').'uploads/profile_picture/'.$this->profile_pic;
    }

    public function usersProfile() {
        return $this->belongsTo('App\Models\Frontend\UsersProfile', 'users_profiles_id', 'id');
    }

    public function getUsersProfile($field = '') {
		$usersProfile = $this->usersProfile()->first();
		if(null === $usersProfile){
			$usersProfile = $this->usersProfile()->first();
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
