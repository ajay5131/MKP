<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Frontend\Itinerary;
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

class JobsController extends BaseController
{
    public function index(Request $request)
    {
        $jobs = Projects::select('id','title','project_type_id','country_id','city_id', 'image')
                            ->where('project_category', 3)
                            ->get();
        return view('frontend.jobs.job-list', compact('jobs')); 
    }

    
    public function addJob(Request $request)
    {
         $user_profile_id = Auth::guard('user')->user()->profile_id;
         $project_types = ProjectType::pluck('project_type', 'project_type_id')->toArray();
        if($user_profile_id != ''){
           $profile_arr = explode(',', $user_profile_id);
           $profile_arr = \General::getParticularUserProfile($profile_arr);
        }

        return view('frontend.jobs.job-add', compact('profile_arr', 'project_types')); 
    }

    public function storeJob(Request $request)
    {  
        $this->validate($request,[
            'users_profiles_id'=>'required',
            'project_type_id'=>'required',
            'title'=>'required|max:100|unique:projects',
            'job_language_id'=>'required',
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
        
        $request_data = [];

        $project_tag = isset($request->project_tag) ? $request->project_tag:"";  

        $request_data['users_profiles_id'] = isset($request->users_profiles_id) ? $request->users_profiles_id:"";
        $request_data['project_type_id'] = isset($request->project_type_id) ? $request->project_type_id:"";
        $request_data['title'] = isset($request->title) ? $request->title:"";
        $request_data['project_category'] = 3;
        $request_data['job_language_id'] = isset($request->job_language_id) ? $request->job_language_id:"";
        $request_data['country_id'] = isset($request->country_id) ? $request->country_id:"";
        $request_data['state_id'] = isset($request->state_id) ? $request->state_id:"";
        $request_data['city_id'] = isset($request->city_id) ? $request->city_id:"";
        $request_data['interest_id'] = isset($request->interest_id) ? implode(',',$request->interest_id) :"";
        $request_data['image']   = isset($main_image) ? $main_image:""; 
        $request_data['description'] = isset($request->description) ? strip_tags($request->description):"";
        $request_data['expiry_date'] = isset($request->expiry_date) ? $request->expiry_date:"";
        $request_data['fields'] = isset($request->fields) ? $request->fields:"";
        $request_data['no_of_people'] = isset($request->no_of_people) ? $request->no_of_people:"";
        $request_data['size'] = isset($request->size) ? $request->size:"";
        $request_data['job_atmosphere'] = isset($request->job_atmosphere) ? $request->job_atmosphere:"";
        $request_data['job_description'] = isset($request->job_description) ? strip_tags($request->job_description):""; 
        $request_data['skills'] = isset($request->skills) ? $request->skills:""; 
        $request_data['education'] = isset($request->education) ? $request->education:""; 
        $request_data['bonus'] = isset($request->bonus) ? $request->bonus:"";
        $request_data['experience'] = isset($request->experience) ? $request->experience:""; 
        $request_data['employment_type'] = isset($request->employment_type) ? $request->employment_type:"";
        $request_data['day_hours'] = isset($request->day_hours) ? $request->day_hours:"";
        $request_data['salary'] = isset($request->salary) ? $request->salary:"";
        $request_data['role_title'] = isset($request->role_title) ? $request->role_title:"";
        $request_data['shifts'] = isset($request->shifts) ? implode(',',$request->shifts) :"";


       
         
        $last_id = Projects::insertGetId($request_data);
        
            if(count($project_tag) > 0 ){
                foreach($project_tag as $key => $value){   
                    ProjectTag::create([
                        'project_id' => $last_id,
                        'project_tag' => $value,
                        'project_category' => 3
                    ]);   
                }
            }else{
                return redirect()->route('posted.job')->with('success','Added successfully!');
            }
        

       return redirect()->route('posted.job')->with('success','Added successfully!');
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

    

    public function jobDetails(Request $request, $id)
    {
       $user_id = Auth::guard('user')->user()->id;
       $project =  Projects::where('id', $id)->where('project_category', 3)->first();
        $project_tags = ProjectTag::where('project_id', $id)->where('project_category',3)->get();

        $project_media_title = ProjectMediaTitle::where('project_id', $id)->where('project_category', 3)->get();

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
                        ->where('project_media_title.project_category', 3)
                        //->where('m.media_type', 'video')
                        ->get(); 

        $designer = ProjectRole::where('project_role_category', 1)->first();                
        $investor = ProjectRole::where('project_role_category', 2)->first();                

        $profile_overview = UsersProfilePicture::where('users_profiles_id', $user_id)->first();                
      
         return view('frontend.jobs.job-details', compact('project', 'keypeoples', 'project_tags','project_media_title','project_media_title_result','project_role_categories','profile_arr','profile_overview','designer','investor')); 
        
    }

    public function addMedia(Request $request)
    {
        if($request->ajax()){
          $media_cat_type =  $request->media_cat_type;  
          
          if($media_cat_type == 1){
            $this->validate($request,[ 
                'title'=>'required|max:100|unique:project_media_title'
            ]);

              $title = $request->title;
              $firstAppData = [];
              $firstAppData['title'] = $title;
              $firstAppData['project_id'] = $request->project_id; 
              $firstAppData['project_category'] = 2;
              $firstAppData['sort_order'] = 1;
              

            ProjectMediaTitle::insertGetId($firstAppData);
             
          }else if($media_cat_type == 2){ 

            $this->validate($request,[ 
                'title_id'=>'required',
                'media' => 'required|mimes:png,jpg,jpeg|max:2048'
            ]);

            

            if($request->hasFile('media')){
                $image_name = $request->media;
                $main_image = $this->imageUpload($image_name);
             } 

             $secondAppData['title_id'] = $request->title_id; 
             $secondAppData['project_id'] = $request->project_id; 
             $secondAppData['project_category'] = 2; 
             $secondAppData['media'] = $main_image;
             $secondAppData['media_type'] = 'image';
             $secondAppData['description'] = $request->description; 

             ProjectMedia::insert($secondAppData);


          }else if($media_cat_type == 3){
            $youtube =  $request->youtube;  

            if($youtube == 1){
                $this->validate($request,[ 
                    'title_id'=>'required',
                    'youtube_media' => 'required|mimes:mp4|max:2048'
                ]);

                if($request->hasFile('youtube_media')){
                    $image_name = $request->youtube_media;
                    $media = $this->imageUpload($image_name);
                    $media_type = 'video';
                 } 
            }else{
                $media =  $request->youtube_link; 
                $media_type = 'audio';  
            } 
             $secondAppData['title_id'] = $request->title_id; 
             $secondAppData['project_id'] = $request->project_id;
             $secondAppData['project_category'] = 2;  
             $secondAppData['media'] = $media;
             $secondAppData['media_type'] = $media_type;
             $secondAppData['description'] = $request->description; 

             ProjectMedia::insert($secondAppData);
          }  

         } 
    }

    public function updateMedia(Request $request)
    { 
       if($request->ajax()){
            $id = $request->id;
            $title = $request->title;

            if($id!='' && $title!=''){
            $last = ProjectMediaTitle::where('id', $id)->update(['title' => $title]);

            return response()->json(['success' => true, 'msg' => 'Successfully Updated']);
            } 
       }
    }

    public function deleteMedia(Request $request)
    { 
       if($request->ajax()){
            $id = $request->id; 

            if($id!=''){
            $last = ProjectMediaTitle::where('id', $id)->delete();

            return response()->json(['success' => true, 'msg' => 'Successfully Deleted']);
            } 
       }
    }

    public function addRole(Request $request)
    {
        $this->validate($request,[
            'project_role_category'=>'required',
            'role_title'=>'required',
            'keypeople'=>'required', 
            //'image' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);

        if($request->hasFile('image')){
            $image_name = $request->image;
            $main_image = $this->imageUpload($image_name);
         }else{
            $main_image = '';
         }

        $user_id = Auth::guard('user')->user()->id;  
        $request_data = [];

        $request_data['project_id'] = $request->project_id; 
        $request_data['is_wanted'] = $request->has('is_wanted')?$request->is_wanted:0;
        $request_data['image'] = $main_image;        
        $request_data['project_role_category'] = $request->project_role_category;
        $request_data['role_title'] = $request->role_title;
        $request_data['compensation'] = $request->compensation;
        $request_data['price'] = $request->has('price')?$request->price:0;
        $request_data['keypeople'] = $request->keypeople;
        $request_data['role_created_by'] = $user_id; 

         ProjectRole::insertGetId($request_data);
        

         return response()->json(['success' => true, 'msg' => 'Successfully Added Role']);
    }
  
    public function updateAddedForm(Request $request)
    {
        if($request->ajax()){
         $profile_id = $request->profile_id;  
         User::where('id', Auth::guard('user')->user()->id)->update(['profile_id' => $profile_id]);
         return response()->json(['msg' => 'Successfully Updated']);
        }
    }


    public function editRoleProject(Request $request)
    {
        if($request->ajax()){
            $edit_role_id = $request->edit_role_id;  
            $edit_role_result = ProjectRole::where('id', $edit_role_id)->first();   

            return response()->json($edit_role_result);
        }
    }

    //Edit job 

    public function editjob(Request $request, $id)
    {
        
        $user_profile_id = Auth::guard('user')->user()->profile_id;
       
        $project = Projects::with('project_tags')->where('id', $id)->where('project_category',3)->first();
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

        $shifts = explode(",",$project->shifts);
        return view('frontend.jobs.job-edit', compact('countries','states', 'cities' , 'profile_arr', 'project_types','project','shifts')); 
    }

    //Update job
    public function updateJob(Request $request, $id)
    {  
        $this->validate($request,[
            'users_profiles_id'=>'required',
            'project_type_id'=>'required',
            'title'=>'required|max:100',
            'job_language_id'=>'required',
            'interest_id'=>'required',
            'description'=>'required',
            'project_tag'=>'required',
            'country_id'=>'required',
            'state_id'=>'required',
            'city_id'=>'required',
            //'image' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);

        $images =  Projects::where('id',$id)->select('id', 'image')->first();
        if($request->hasFile('image')){
            $image_name = $request->image;
            $main_image = $this->imageUpload($image_name);
         }else{
            $main_image = $images->image; 
         }

        
        $request_data = [];

        $project_tag = isset($request->project_tag) ? $request->project_tag:"";  

        $request_data['users_profiles_id'] = isset($request->users_profiles_id) ? $request->users_profiles_id:"";
        $request_data['project_type_id'] = isset($request->project_type_id) ? $request->project_type_id:"";
        $request_data['title'] = isset($request->title) ? $request->title:"";
        $request_data['project_category'] = 3;
        $request_data['job_language_id'] = isset($request->job_language_id) ? $request->job_language_id:"";
        $request_data['country_id'] = isset($request->country_id) ? $request->country_id:"";
        $request_data['state_id'] = isset($request->state_id) ? $request->state_id:"";
        $request_data['city_id'] = isset($request->city_id) ? $request->city_id:"";
        $request_data['interest_id'] = isset($request->interest_id) ? implode(',',$request->interest_id) :"";
        $request_data['image']   = isset($main_image) ? $main_image:""; 
        $request_data['description'] = isset($request->description) ? strip_tags($request->description):"";
        $request_data['expiry_date'] = isset($request->expiry_date) ? $request->expiry_date:"";
        $request_data['fields'] = isset($request->fields) ? $request->fields:"";
        $request_data['no_of_people'] = isset($request->no_of_people) ? $request->no_of_people:"";
        $request_data['size'] = isset($request->size) ? $request->size:"";
        $request_data['job_atmosphere'] = isset($request->job_atmosphere) ? $request->job_atmosphere:"";
        $request_data['job_description'] = isset($request->job_description) ? strip_tags($request->job_description):""; 
        $request_data['skills'] = isset($request->skills) ? $request->skills:""; 
        $request_data['education'] = isset($request->education) ? $request->education:""; 
        $request_data['bonus'] = isset($request->bonus) ? $request->bonus:"";
        $request_data['experience'] = isset($request->experience) ? $request->experience:""; 
        $request_data['employment_type'] = isset($request->employment_type) ? $request->employment_type:"";
        $request_data['day_hours'] = isset($request->day_hours) ? $request->day_hours:"";
        $request_data['salary'] = isset($request->salary) ? $request->salary:"";
        $request_data['role_title'] = isset($request->role_title) ? $request->role_title:"";
        $request_data['shifts'] = isset($request->shifts) ? implode(',',$request->shifts) :"";


       //return $request_data;
         
        $updateData = Projects::where('id',$id)->update($request_data);
        
            if(count($project_tag) > 0 ){
                
                ProjectTag::where('project_id', $id)->where('project_category',3)->delete(); 
                foreach($project_tag as $key => $value){  
                    
                    ProjectTag::create(['project_id' => $id, 'project_tag' => $value,'project_category' => 3]); 
                }
            }else{
                return redirect()->route('posted.job')->with('success','Added successfully!');
            }
        

       return redirect()->route('posted.job')->with('success','Added successfully!');
    }

    public function addItinerary(Request $request)
    {
        //return response()->json($request->all());
        $this->validate($request,[
            'title'=>'required',
            'itinerary_value'=>'required',
        ]);

        $request_data = [];
        foreach($request->title as $key=>$itinerary){
            $request_data['project_id'] = $request->project_id; 
            $request_data['title'] = $request->title[$key];
            $request_data['itinerary_value'] = $request->itinerary_value[$key]; 
           
            Itinerary::insertGetId($request_data);
        }
        return response()->json(['success' => true, 'msg' => 'Successfully Added Initerary']);
    }

    public function editItinerary(Request $request)
    {
        
        if($request->ajax()){
            $edit_itinerary_id = $request->edit_itinerary_id;  
            $edit_itinerary_result = Itinerary::where('id', $edit_itinerary_id)->first();   

            return response()->json($edit_itinerary_result);
        }
    }

    //Update Itinerary

    public function updateItinerary(Request $request)
    {  
        $this->validate($request,[
            'title'=>'required',
            'itinerary_value'=>'required',
        ]);
        $request_data = [];
        foreach($request->title as $key=>$itinerary){
            $request_data['project_id'] = $request->project_id;
            $request_data['title'] = isset($request->title) ? $request->title[$key]:"";
            $request_data['itinerary_value'] = isset($request->itinerary_value) ? $request->itinerary_value[$key]:"";
            
            $updateData = Itinerary::where('id',$request->initerary_id)->update($request_data);
            return response()->json(['success' => true, 'msg' => 'Successfully updated Initerary']);
        }

    }

    //delete Itinerary

    public function deleteItinerary(Request $request)
    { 
        if($request->ajax()){
            $id = $request->id; 

            if($id!=''){
                $last = Itinerary::where('id', $id)->delete();
                return response()->json(['success' => true, 'msg' => 'Successfully Deleted']);
            } 
        }
    }

    
}