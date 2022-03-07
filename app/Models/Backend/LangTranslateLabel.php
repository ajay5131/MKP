<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class LangTranslateLabel extends Model
{
	protected $table = 'lang_translate_label';
    protected $fillable = [
        'title'
    ];
    public $timestamps = false;
    
}
