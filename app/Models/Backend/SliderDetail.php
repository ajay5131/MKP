<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class SliderDetail extends Model
{
	protected $table = 'slider_detail';
    protected $fillable = [
        'slider_id', 'language_id', 'title', 'description'
    ];
    public $timestamps = false;

}
