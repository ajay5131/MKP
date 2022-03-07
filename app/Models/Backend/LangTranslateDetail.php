<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class LangTranslateDetail extends Model
{
	protected $table = 'lang_translate_detail';
    protected $fillable = [
        'language_id', 'lang_translate_id', 'value'
    ];
    public $timestamps = false;

}
