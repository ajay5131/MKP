<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
	protected $table = 'slider';
    protected $fillable = [
        'language_id', 'slider_type', 'title','title_fr', 'description', 'description_fr', 'media', 'media_type', 'is_active', 'show_more_btn_link'
    ];
    public $timestamps = true;
    protected $dates = ['created_at', 'updated_at'];

}
