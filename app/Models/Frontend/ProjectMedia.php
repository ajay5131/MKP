<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class ProjectMedia extends Model
{
    protected $table = 'project_media';
    protected $fillable = [
        'project_id','media','media_type','description','title_id','layout','layout_id','likes','locked','location_id','created_at','updated_at'
    ];

 }
