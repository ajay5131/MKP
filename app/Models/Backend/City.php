<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\State;

class City extends Model
{
	protected $table = 'city';
    protected $fillable = [
        'title', 'state_id', 'title_fr'
    ];
    public $timestamps = true;
    protected $dates = ['created_at', 'updated_at'];


    public function getCountryId()
    {

        if(null !== $state = $this->state_id){
            $state = State::where('id', $this->state_id)->pluck('country_id')->toArray();
            return $state[0];
		}
    }

}
