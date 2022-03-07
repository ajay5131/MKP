<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class ProjectType extends Model
{
    protected $table = 'project_type';
    protected $fillable = [
        'project_type'
    ];

    public $timestamps = false; 
}
