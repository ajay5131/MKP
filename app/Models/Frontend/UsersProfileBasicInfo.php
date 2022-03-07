<?php

namespace App\Models\Frontend;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UsersProfileBasicInfo extends Model
{
	protected $table = 'users_profile_basic_info';
    
    public $timestamps = false;
    protected $guarded = [];


}
