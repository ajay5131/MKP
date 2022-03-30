<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Frontend\Projects;
use App\Models\Frontend\ProjectTag;
use App\Models\Frontend\ProjectType;
use App\Models\Frontend\ProjectMedia;
use App\Models\Frontend\ProjectMediaTitle;
use App\Models\Frontend\UsersProfilePicture;
use App\Models\Frontend\KeyPeopleTitles;
use App\Models\Frontend\ProjectRole;
use App\Models\Frontend\ProjectRoleCategory;
use App\Models\Backend\Country;
use App\Models\Backend\State;
use App\Models\Backend\City;
use App\User;
use Auth;

class ListingController extends BaseController
{
    public function index(Request $request)
    {
        $projects = Projects::select('id','title','project_type_id','country_id','city_id', 'image')
                            ->where('project_category',4) 
                            ->get();
        return view('frontend.listing.listing-list', compact('projects')); 
    }

    public function projectCategoryList(Request $request)
    {
        $total_projects = Projects::where('project_category', 1)->count();
        $total_travels = Projects::where('project_category', 2)->count();
        $total_jobs = Projects::where('project_category', 3)->count();
        $total_listings = Projects::where('project_category', 4)->count();
        $total_events = Projects::where('project_category', 5)->count();

        return view('frontend.listing.listing-list', compact('total_projects','total_travels','total_jobs','total_listings','total_events')); 
    }

    public function addListing(Request $request)
    {
        $user_profile_id = Auth::guard('user')->user()->profile_id;

        if($user_profile_id != ''){
           $profile_arr = explode(',', $user_profile_id);
           $profile_arr = \General::getParticularUserProfile($profile_arr);
        }

       $project_types = ProjectType::pluck('project_type', 'project_type_id')->toArray();
 
        return view('frontend.listing.list-add', compact('profile_arr', 'project_types')); 
    }

    public function fetchState(Request $request)
    {
        $data['states'] = State::where("country_id",$request->country_id)->get(["title", "id"]);
        return response()->json($data);
    }

    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("state_id",$request->state_id)->get(["title", "id"]);
        return response()->json($data);
    }

    public function storeListing(Request $request)
    {  
        $this->validate($request,[
            'users_profiles_id'=>'required',
            'project_type_id'=>'required',
            'title'=>'required|max:100|unique:projects',
            'language_id'=>'required',
            'interest_id'=>'required',
            'description'=>'required',
            'project_tag'=>'required',
            'country_id'=>'required',
            'state_id'=>'required',
            'city_id'=>'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);

        if($request->hasFile('image')){
            $image_name = $request->image;
            $main_image = $this->imageUpload($image_name);
         }else{
              
         }

         if($request->hasFile('additional_images')){
            $images = $request->additional_images;
            $additional_image = $this->imageUpload($images);
         }else{
              
         }
        
        $request_data = [];

        $project_tag = isset($request->project_tag) ? $request->project_tag:"";  

        $request_data['users_profiles_id'] = isset($request->users_profiles_id) ? $request->users_profiles_id:"";
        $request_data['project_type_id'] = isset($request->project_type_id) ? $request->project_type_id:"";
        $request_data['project_category'] = 4;
        $request_data['title'] = isset($request->title) ? $request->title:"";
        $request_data['language_id'] = isset($request->language_id) ? $request->language_id:"";
        $request_data['interest_id'] = implode(',',$request->interest_id);
        $request_data['description'] = isset($request->description) ? $request->description:"";
        $request_data['country_id'] = isset($request->country_id) ? $request->country_id:"";
        $request_data['state_id'] = isset($request->state_id) ? $request->state_id:"";
        $request_data['city_id'] = isset($request->city_id) ? $request->city_id:"";
        $request_data['locked'] = isset($request->locked) ? $request->locked:""; 
        $request_data['salary'] = isset($request->price) ? $request->price:""; 

        $request_data['additional_images'] = isset($additional_image) ? $additional_image:""; 
        

        $request_data['from_date'] = now();
        
        $request_data['image']   = isset($main_image) ? $main_image:""; 
        $last_id = Projects::insertGetId($request_data);
        if($last_id!=''){
            if(count($project_tag) > 0 ){
                foreach($project_tag as $key => $value){   
                   ProjectTag::create([
                        'project_id' => $last_id,
                        'project_tag' => $value,
                        'project_category' => 4
                    ]);   
                }
            }
        }

       return redirect()->route('listing.list')->with('success','Added successfully!');
    }

    public function listDetails(Request $request, $id )
    {
       $user_id = Auth::guard('user')->user()->id;
       $project =  Projects::where('id', $id)->first();
       $project_tags = ProjectTag::where('project_id', $id)->where('project_category',4)->get();

       $project_media_title = ProjectMediaTitle::where('project_id', $id)->get();

       $project_role_categories = ProjectRoleCategory::get();
       $keypeoples = KeyPeopleTitles::where('users_id', $user_id)->get();


       $user_profile_id = Auth::guard('user')->user()->profile_id;

       if($user_profile_id != ''){
          $profile_arr = explode(',', $user_profile_id);
          $profile_arr = \General::getParticularUserProfile($profile_arr);
       }


       $project_media_title_result = ProjectMediaTitle::leftJoin('project_media as m','project_media_title.id','=','m.title_id')
                        ->select('project_media_title.id','project_media_title.title','m.media_type', 'm.media')
                        ->where('project_media_title.project_id', $id)
                      //  ->where('m.media_type', 'video')
                        ->get(); 

        $designer = ProjectRole::where('project_role_category', 1)->first();                
        $investor = ProjectRole::where('project_role_category', 2)->first();                

        $profile_overview = UsersProfilePicture::where('users_profiles_id', $user_id)->first();                

         return view('frontend.listing.list-details', compact('project', 'keypeoples', 'project_tags','project_media_title','project_media_title_result','project_role_categories','profile_arr','profile_overview','designer','investor')); 
        
    }

    
    
    public function updateAddedForm(Request $request)
    {
        if($request->ajax()){
         $profile_id = $request->profile_id;  
         User::where('id', Auth::guard('user')->user()->id)->update(['profile_id' => $profile_id]);
         return response()->json(['msg' => 'Successfully Updated']);
        }
    }


   
    //Edit Project 

    public function editListing(Request $request, $id)
    {
        
        $user_profile_id = Auth::guard('user')->user()->profile_id;
       
        $project =  $project = Projects::with('project_tags')->where('id', $id)->first();
        $project->interest_id = explode(",",$project->interest_id);
        if($user_profile_id != ''){
           $profile_arr = explode(',', $user_profile_id);
           $profile_arr = \General::getParticularUserProfile($profile_arr);
        }

        $countries = Country::with(['stateList'=>function ($q){
            $q->with('citiesList');
          }])->select('id','title')->get()->toArray(); 
        $states = State::where('country_id', $project->country_id)->get();

        $cities = City::where('state_id', $project->state_id)->get();

        $project_types = ProjectType::pluck('project_type', 'project_type_id')->toArray();
        //return $project;
        return view('frontend.listing.list-edit', compact('countries','states', 'cities' , 'profile_arr', 'project_types','project')); 
    }

    //Update Project

    public function updateListing(Request $request, $id)
    {  
        
        $this->validate($request,[
            'users_profiles_id'=>'required',
            'project_type_id'=>'required',
            'title'=>'required|max:100',
            'language_id'=>'required',
            'interest_id'=>'required',
            'description'=>'required',
            'project_tag'=>'required',
            'country_id'=>'required',
            'state_id'=>'required',
            'city_id'=>'required',
           // 'image' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);

        $images =  Projects::where('id',$id)->select('id', 'image','additional_images')->first();
        if($request->hasFile('image')){
            $image_name = $request->image;
            $main_image = $this->imageUpload($image_name);
         }else{
            $main_image = $images->image; 
         }

         if($request->hasFile('additional_images')){
            $additional_img = $request->additional_images;
            $additional_images = $this->imageUpload($additional_img);
         }else{
            $additional_images = $images->additional_images; 
         }

        $request_data = [];
        
        $project_tag = isset($request->project_tag) ? $request->project_tag:"";  
        $request_data['users_profiles_id'] = isset($request->users_profiles_id) ? $request->users_profiles_id:"";
        $request_data['project_type_id'] = isset($request->project_type_id) ? $request->project_type_id:"";
        $request_data['project_category'] = 4;
        $request_data['title'] = isset($request->title) ? $request->title:"";
        $request_data['language_id'] = isset($request->language_id) ? $request->language_id:"";
        $request_data['interest_id'] = implode(',',$request->interest_id);
        $request_data['description'] = isset($request->description) ? $request->description:"";
        $request_data['country_id'] = isset($request->country_id) ? $request->country_id:"";
        $request_data['state_id'] = isset($request->state_id) ? $request->state_id:"";
        $request_data['city_id'] = isset($request->city_id) ? $request->city_id:"";
        $request_data['locked'] = isset($request->locked) ? $request->locked:""; 
        $request_data['from_date'] = now();
        $request_data['salary'] = isset($request->price) ? $request->price:""; 
        $request_data['image']   = isset($main_image) ? $main_image:""; 
        $request_data['additional_images']   = isset($additional_images) ? $additional_images:""; 
       
        $updateData = Projects::where('id',$id)->update($request_data);
        
        
            if(count($project_tag) > 0 ){
                ProjectTag::where('project_id', $id)->where('project_category',4)->delete(); 
                
                foreach($project_tag as $key => $value){  
                    
                    ProjectTag::create(['project_id' => $id, 'project_tag' => $value, 'project_category'=>4]); 
                }
            }
    
        return redirect()->route('listing.list')->with('success','Added successfully!');
    }
    
}