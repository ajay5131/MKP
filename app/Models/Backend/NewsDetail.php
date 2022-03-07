<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class NewsDetail extends Model
{
	protected $table = 'news_detail';
    protected $fillable = [
        'news_id', 'language_id', 'title', 'description'
    ];
    public $timestamps = false;

}
