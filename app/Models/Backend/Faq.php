<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
	protected $table = 'faq';
    protected $fillable = [
        'question','question_fr', 'answer', 'answer_fr', 'sort_order'
    ];
    public $timestamps = true;
    protected $dates = ['created_at', 'updated_at'];

}
