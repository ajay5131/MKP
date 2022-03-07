<?php

namespace App\Models\Frontend;
use Illuminate\Database\Eloquent\Model;


class UsersProfileMediaComments extends Model
{
	protected $table = 'users_profile_media_comments';
    
	public $timestamps = true;

	protected $guarded = [];
	protected $dates = ['created_at'];
	
	const UPDATED_AT = null;

	public function usersProfile() {
        return $this->belongsTo('App\Models\Frontend\UsersProfile', 'commenter_id', 'id');
    }


}
