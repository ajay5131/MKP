<?php

namespace App\Models\Frontend;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UsersProfileOverview extends Model
{
	protected $table = 'users_profile_details';
    public $timestamps = false;

    protected $guarded = [];
}
