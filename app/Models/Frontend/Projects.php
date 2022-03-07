<?php

namespace App\Models\Frontend;
use App\Models\Frontend\ProjectTag;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
	protected $table = 'projects';

    protected $fillable = [
        'users_profiles_id', 'project_type_id', 'title', 'project_category', 'language_id', 'interest_id', 'image', 'description', 'country_id', 'state_id', 'city_id', 'tags', 'from_date', 'to_date', 'from_time', 'to_time', 'locked', 'no_of_people', 'budget', 'accommodation_type', 'recurrence', 'event_description', 'fields', 'size', 'job_atmosphere', 'bonus', 'role_title', 'job_description', 'job_language_id', 'skills', 'education', 'experience', 'employement_type', 'day_hours', 'shifts', 'additional_images', 'likes', 'followers', 'is_archived', 'views', 'youtube_link', 'instagram_link', 'facebook_link', 'is_best', 'is_crowdfunding'
    ];
    public $timestamps = false; 


    public function project_tags()
    {
        return $this->hasMany(ProjectTag::class, 'project_id', 'id');
    }
}
