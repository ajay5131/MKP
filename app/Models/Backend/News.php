<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
	protected $table = 'news';
    protected $fillable = [
        'language_id', 'title','title_fr', 'description', 'description_fr', 'media', 'slug'
    ];
    public $timestamps = true;
    protected $dates = ['created_at', 'updated_at'];

}
