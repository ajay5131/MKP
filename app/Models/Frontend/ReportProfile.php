<?php

namespace App\Models\Frontend;
use Illuminate\Database\Eloquent\Model;


class ReportProfile extends Model
{
	protected $table = 'report_profile';
    
	public $timestamps = true;

	protected $dates = ['created_at', 'updated_at'];
	protected $guarded = [];

}
