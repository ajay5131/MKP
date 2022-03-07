<?php

namespace App\Http\Controllers\Backend;

use Form;
use App\Http\Controllers\Controller;
use App\Models\Backend\State;
use App\Models\Backend\Country;
use Illuminate\Http\Request;

class CommonController extends Controller {

    public function getStatesByCountry(Request $request) {
        
        $country_id = $request->country_id;
        $state_id = $request->state_id;
        $states = State::where('country_id', $country_id)->orderBy('title', 'ASC')->pluck('title', 'id')->toArray();
        
        echo Form::select('state_id', ['' => 'Select State']+ $states, $state_id, array('class'=>'form-control select2', 'id'=>'state_id'));
    }
}
