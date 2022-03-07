<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class PagesDetail extends Model
{
	protected $table = 'page_contents_detail';
    protected $fillable = [
        'page_contents_id', 'language_id', 'sub_title', 'description'
    ];
    public $timestamps = false;

}
