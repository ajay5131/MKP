<?php

namespace App\Models\Frontend;
use Illuminate\Database\Eloquent\Model;


class UsersProfilePictureComments extends Model
{
	protected $table = 'users_profile_picture_comments';
    
	public $timestamps = true;

	protected $guarded = [];
	protected $dates = ['created_at'];
	
	const UPDATED_AT = null;

	public function usersProfile() {
        return $this->belongsTo('App\Models\Frontend\UsersProfile', 'commenter_id', 'id');
    }


}
