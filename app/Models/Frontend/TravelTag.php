<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class TravelTag extends Model
{
    protected $table = 'travel_tags';
    protected $fillable = [
        'travel_tag_id','travel_id','travel_tag'
    ];

    public $timestamps = false; 
}
