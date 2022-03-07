<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class ProjectRole extends Model
{
    protected $table = 'project_roles';
    protected $fillable = [
        'project_id','is_wanted','image','project_role_category','role_title','compensation','price','keypeople','role_created_by'
    ];
}
