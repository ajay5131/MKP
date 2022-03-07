<?php

namespace App\Models\Frontend;
use Illuminate\Database\Eloquent\Model;


class Review extends Model
{
	protected $table = 'profiles_review';
    
	public $timestamps = true;

	protected $dates = ['created_at', 'updated_at'];
	protected $guarded = [];

	public function reviewer() {
		return $this->belongsTo('App\Models\Frontend\UsersProfile', 'reviewer_users_profile_id', 'id');
	}

	public function getReviewer($field = '') {
		$reviewer = $this->reviewer()->first();
		
		if(null === $reviewer){
			$reviewer = $this->reviewer()->first();
		}
		if(null !== $reviewer){
			if (!empty($field)) {
				return $reviewer->$field;
			} else {
				return $reviewer;
			}
		}
	}


}
