<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class UsersProfileSocialMedia extends Model
{
	protected $table = 'users_profile_social_media';
    protected $fillable = [
        'users_profiles_id', 'social_media', 'social_media_link'
    ];
    public $timestamps = false;
}
