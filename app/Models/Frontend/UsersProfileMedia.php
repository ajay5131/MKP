<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class UsersProfileMedia extends Model
{
	protected $table = 'users_profile_media';
    public $timestamps = true;
    protected $dates = ['created_at', 'updated_at'];
    protected $guarded = [];

    protected $appends = ['image_path'];

    public function getImagePathAttribute(){
        switch($this->media_type) {
            case 'jpg': case 'png': case 'jpeg': case 'pdf': case 'mp4':
                return asset('/').'uploads/portofolio/'.$this->media;
                break;

            default:
                return $this->media;
                break;
        }
        
    }

    public function usersProfile() {
        return $this->belongsTo('App\Models\Frontend\UsersProfile', 'users_profiles_id', 'id');
    }

}
