<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class TeamDetail extends Model
{
	protected $table = 'our_team_detail';
    protected $fillable = [
        'language_id', 'full_name','designation', 'description'
    ];
    public $timestamps = false;

}
