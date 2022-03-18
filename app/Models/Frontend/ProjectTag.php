<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class ProjectTag extends Model
{
    protected $table = 'project_tags';
    protected $fillable = [
        'project_tag_id','project_id','project_tag','project_category'
    ];

    public $timestamps = false; 
}
