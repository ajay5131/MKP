<?php

namespace App\Http\Controllers\Frontend;

use App;
use Session;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Rules\ValidateArrayElement;
use Illuminate\Validation\Rule; 
use App\Models\Frontend\UsersProfile;

class SearchController extends Controller {

    public function index(Request $request)
    {
        $search_keyword = $request->keyword;
        $search_category = $request->category;
        $search_location = $request->location;
        $search_result = UsersProfile::join('countries','countries.id','users_profiles.country_id')
                            ->join('state','state.id','users_profiles.state_id')
                            ->join('city','city.id','users_profiles.city_id')
                            ->where('users_profiles.profile_id', $search_category)
                            ->where(function($query) use ($search_keyword){
                            $query->where('full_name', 'LIKE', '%'.$search_keyword.'%')
                                  ->orWhere('handle_name', 'LIKE', '%'.$search_keyword.'%')
                                  ->orWhere('countries.title', 'LIKE', '%'.$search_keyword.'%');
                            })
                            ->where(function($query) use ($search_location){
                            $query->where('countries.title', 'LIKE', '%'.$search_location.'%')
                                ->orWhere('state.title', 'LIKE', '%'.$search_location.'%')
                                ->orWhere('city.title', 'LIKE', '%'.$search_location.'%');
                            })->with('country','city','state')->get();
  
        //print_r($search_result);

        //return $profile->orderBy('id', 'DESC')->paginate(10);
        return view('frontend.search.search', ['search_result' => $search_result]);
    }    
}