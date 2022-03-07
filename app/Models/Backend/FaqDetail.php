<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class FaqDetail extends Model
{
	protected $table = 'faq_detail';
    protected $fillable = [
        'language_id', 'faq_id', 'question','answer'
    ];
    public $timestamps = false;

}
