<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
	protected $table = 'our_team';
    protected $fillable = [
        'language_id', 'full_name','full_name_fr', 'designation', 'designation_fr', 'media', 'sort_order', 'team_type', 'tag_id', 'description', 'description_fr'
    ];
    public $timestamps = true;
    protected $dates = ['created_at', 'updated_at'];

}
