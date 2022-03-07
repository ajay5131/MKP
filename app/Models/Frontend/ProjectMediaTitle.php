<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class ProjectMediaTitle extends Model
{
    protected $table = 'project_media_title';
    protected $fillable = [
        'project_id','project_category','title','sort_order','created_at','updated_at'
    ];

 }
