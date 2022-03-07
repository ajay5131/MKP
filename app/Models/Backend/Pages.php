<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
	protected $table = 'page_contents';
    protected $fillable = [
        'description', 'description_fr', 'sub_title', 'sub_title_fr'
    ];
    public $timestamps = true;
    protected $dates = ['updated_at'];

}
