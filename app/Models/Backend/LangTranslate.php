<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class LangTranslate extends Model
{
	protected $table = 'lang_translate';
    protected $fillable = [
        'language_id', 'lang_translate_label_id', 'value'
    ];
    public $timestamps = true;
    protected $dates = ['updated_at'];

}
