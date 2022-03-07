<?php

namespace App\Models\Frontend;
use Illuminate\Database\Eloquent\Model;


class KeylistMedia extends Model
{
	protected $table = 'keylist_media';
    
	public $timestamps = true;

	protected $dates = ['created_at', 'updated_at'];
	protected $guarded = [];


    public function getMediaDetail() {
		$modal_name = '\App\Models\Frontend\\' . $this->media_tbl;
        
        $media_detail = $modal_name::where('id', $this->media_id);
		if($this->media_tbl != "UsersProfile" && $this->media_tbl != "KeylistMedia") {
			$media_detail->with('usersProfile');
		}

		return $media_detail->first();

		// return $media_detail;
    }
	
}
