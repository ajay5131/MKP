<?php

namespace App\Models\Frontend;
use Illuminate\Database\Eloquent\Model;


class DealList extends Model
{
	protected $table = 'deallist';
    
	public $timestamps = true;

	protected $dates = ['created_at', 'updated_at'];
	protected $guarded = [];

	public function senderName() {
		return $this->belongsTo('App\Models\Frontend\UsersProfile', 'sender_id', 'users_id');
	}

	public function getSenderName($field = '') {
		$senderName = $this->senderName()->where('profile_id', $this->profile_id)->first();
		
		if(null === $senderName){
			$senderName = $this->senderName()->where('profile_id', $this->profile_id)->first();
		}
		if(null !== $senderName){
			if (!empty($field)) {
				return $senderName->$field;
			} else {
				return $senderName;
			}
		}
	}

	public function getStatus() {
		
		$click_event = "openModal('profile-reply-deal-list', '". route('reply.deal', ['deal_id' => $this->id ]). "')";

		switch ($this->status) {
			case 1:case 2:
				return '<button type="button" onclick="'.$click_event.'" class="transparent-btn text-danger">Reply</button>';
				break;
			
			case 3:
				return '<span>Accepted</span>';
				break;
			
			case 4:
				return '<span class="text-secondary">Declined</span>';
				break;
			
		}
	}
}
