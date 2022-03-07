<?php

namespace App\Models\Frontend;
use App\Models\Frontend\TravelTag;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
	protected $table = 'travels';

    protected $fillable = [
        'users_profiles_id', 'travel_type_id', 'title', 'language_id', 'interest_id', 'image', 'description', 'country_id', 'state_id', 'city_id', 'tags', 'travel_start_date', 'travel_end_date', 'locked', 'no_of_people', 'budget', 'accommodation_type'];
    public $timestamps = false; 


    public function travel_tags()
    {
        return $this->hasMany(TravelTag::class, 'travel_id', 'id');
    }
}
