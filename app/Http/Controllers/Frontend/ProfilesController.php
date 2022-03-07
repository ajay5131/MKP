<?php

namespace App\Http\Controllers\Frontend;

use App;
use Session;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Rules\ValidateArrayElement;
use Illuminate\Validation\Rule; 
use App\Models\Frontend\UsersProfile;
use App\Models\Frontend\UsersProfileOverview;
use App\Models\Frontend\UsersProfileBasicInfo;
use App\Models\Frontend\UsersProfilePicture;
use App\Models\Frontend\UsersProfileMedia;
use App\Models\Frontend\UsersProfileSocialMedia;
use App\Models\Frontend\UsersProfileMediaComments;
use App\Models\Frontend\Visible;
use App\Models\Frontend\Followers;
use App\Models\Frontend\ReportProfile;
use App\Models\Frontend\Review;

class ProfilesController extends Controller {

    public function main($slug) {
        // Check whether user can update the content of profile or not
        Session::put('can_update', false);
        $users_id = \General::getUsersID($slug);
        if(!empty($users_id)) {
            if(Auth::guard('user')->check()) {
                if(Auth::guard('user')->user()->id == $users_id) {
                    Session::put('can_update', true);
                }
            }
            // ==================
    
            // Get User Profile information from users_profiles table
            $profile_overview = UsersProfile::where('handle_name', $slug)->where('profile_id', 1)->first();
            if(!Session::get('can_update')){
                UsersProfile::where('handle_name', $slug)->where('profile_id', 1)->update(['profile_views' => ($profile_overview->profile_views + 1) ]);
            }
            $social_media = UsersProfileSocialMedia::where('users_profiles_id', $profile_overview->id)->pluck('social_media_link', 'social_media')->toArray();
            
            // ==================
            $profile_id = 1;
            $user_profile_id = $profile_overview->id;
    
            return view('frontend.profiles.main_profile')->with('profile_id', $profile_id)->with('user_profile_id', $user_profile_id)->with('social_media', $social_media)->with('can_update', Session::get('can_update'))->with('profile_overview', $profile_overview);

        } else {
            // If no record found then throw 404 error
            abort(404);
        }
    }

    public function musicianSingerProfile($slug) {
        // Check whether user can update the content of profile or not
        Session::put('can_update', false);
        $users_id = \General::getUsersID($slug);
        if(!empty($users_id)) {
            if(Auth::guard('user')->check()) {
                if(Auth::guard('user')->user()->id == $users_id) {
                    Session::put('can_update', true);
                }
            }
            // ==================
    
            // Get User Profile information from users_profiles table
            $profile_overview = UsersProfile::where('handle_name', $slug)->where('profile_id', 2)->first();
            if(!Session::get('can_update')){
                UsersProfile::where('handle_name', $slug)->where('profile_id', 2)->update(['profile_views' => ($profile_overview->profile_views + 1) ]);
            }
            $social_media = UsersProfileSocialMedia::where('users_profiles_id', $profile_overview->id)->pluck('social_media_link', 'social_media')->toArray();
            
            // ==================
            $profile_id = 2;
            $user_profile_id = $profile_overview->id;
    
            return view('frontend.profiles.musician_profile')->with('profile_id', $profile_id)->with('user_profile_id', $user_profile_id)->with('social_media', $social_media)->with('can_update', Session::get('can_update'))->with('profile_overview', $profile_overview);

        } else {
            // If no record found then throw 404 error
            abort(404);
        }
    }

    public function modelActorProfile($slug) {
        // Check whether user can update the content of profile or not
        Session::put('can_update', false);
        $users_id = \General::getUsersID($slug);
        if(!empty($users_id)) {
            if(Auth::guard('user')->check()) {
                if(Auth::guard('user')->user()->id == $users_id) {
                    Session::put('can_update', true);
                }
            }
            // ==================
    
            // Get User Profile information from users_profiles table
            $profile_overview = UsersProfile::where('handle_name', $slug)->where('profile_id', 3)->first();
            if(!Session::get('can_update')){
                UsersProfile::where('handle_name', $slug)->where('profile_id', 3)->update(['profile_views' => ($profile_overview->profile_views + 1) ]);
            }
            $social_media = UsersProfileSocialMedia::where('users_profiles_id', $profile_overview->id)->pluck('social_media_link', 'social_media')->toArray();
            
            // ==================
            $profile_id = 3;
            $user_profile_id = $profile_overview->id;
            
            return view('frontend.profiles.model_actor_profile')->with('profile_id', $profile_id)->with('user_profile_id', $user_profile_id)->with('social_media', $social_media)->with('can_update', Session::get('can_update'))->with('profile_overview', $profile_overview);

        } else {
            // If no record found then throw 404 error
            abort(404);
        }
    }
    
    public function dancerAthleteProfile($slug) {
        // Check whether user can update the content of profile or not
        Session::put('can_update', false);
        $users_id = \General::getUsersID($slug);
        if(!empty($users_id)) {
            if(Auth::guard('user')->check()) {
                if(Auth::guard('user')->user()->id == $users_id) {
                    Session::put('can_update', true);
                }
            }
            // ==================
    
            // Get User Profile information from users_profiles table
            $profile_overview = UsersProfile::where('handle_name', $slug)->where('profile_id', 4)->first();
            if(!Session::get('can_update')){
                UsersProfile::where('handle_name', $slug)->where('profile_id', 4)->update(['profile_views' => ($profile_overview->profile_views + 1) ]);
            }
            $social_media = UsersProfileSocialMedia::where('users_profiles_id', $profile_overview->id)->pluck('social_media_link', 'social_media')->toArray();
            
            // ==================
            $profile_id = 4;
            $user_profile_id = $profile_overview->id;
    
            return view('frontend.profiles.model_actor_profile')->with('profile_id', $profile_id)->with('user_profile_id', $user_profile_id)->with('social_media', $social_media)->with('can_update', Session::get('can_update'))->with('profile_overview', $profile_overview);

        } else {
            // If no record found then throw 404 error
            abort(404);
        }
    }
    
    public function writerDirectorProfile($slug) {
        // Check whether user can update the content of profile or not
        Session::put('can_update', false);
        $users_id = \General::getUsersID($slug);
        if(!empty($users_id)) {
            if(Auth::guard('user')->check()) {
                if(Auth::guard('user')->user()->id == $users_id) {
                    Session::put('can_update', true);
                }
            }
            // ==================
    
            // Get User Profile information from users_profiles table
            $profile_overview = UsersProfile::where('handle_name', $slug)->where('profile_id', 5)->first();
            if(!Session::get('can_update')){
                UsersProfile::where('handle_name', $slug)->where('profile_id', 5)->update(['profile_views' => ($profile_overview->profile_views + 1) ]);
            }
            $social_media = UsersProfileSocialMedia::where('users_profiles_id', $profile_overview->id)->pluck('social_media_link', 'social_media')->toArray();
            
            // ==================
            $profile_id = 5;
            $user_profile_id = $profile_overview->id;
    
            return view('frontend.profiles.writer_director_profile')->with('profile_id', $profile_id)->with('user_profile_id', $user_profile_id)->with('social_media', $social_media)->with('can_update', Session::get('can_update'))->with('profile_overview', $profile_overview);

        } else {
            // If no record found then throw 404 error
            abort(404);
        }
    }

    public function artistDesignerProfile($slug) {
        // Check whether user can update the content of profile or not
        Session::put('can_update', false);
        $users_id = \General::getUsersID($slug);
        if(!empty($users_id)) {
            if(Auth::guard('user')->check()) {
                if(Auth::guard('user')->user()->id == $users_id) {
                    Session::put('can_update', true);
                }
            }
            // ==================
    
            // Get User Profile information from users_profiles table
            $profile_overview = UsersProfile::where('handle_name', $slug)->where('profile_id', 6)->first();
            if(!Session::get('can_update')){
                UsersProfile::where('handle_name', $slug)->where('profile_id', 6)->update(['profile_views' => ($profile_overview->profile_views + 1) ]);
            }
            $social_media = UsersProfileSocialMedia::where('users_profiles_id', $profile_overview->id)->pluck('social_media_link', 'social_media')->toArray();
            
            // ==================
            $profile_id = 6;
            $user_profile_id = $profile_overview->id;
    
            return view('frontend.profiles.artist_designer_profile')->with('profile_id', $profile_id)->with('user_profile_id', $user_profile_id)->with('social_media', $social_media)->with('can_update', Session::get('can_update'))->with('profile_overview', $profile_overview);

        } else {
            // If no record found then throw 404 error
            abort(404);
        }
    }
    
    public function freelancerProfile($slug) {
        // Check whether user can update the content of profile or not
        Session::put('can_update', false);
        $users_id = \General::getUsersID($slug);
        if(!empty($users_id)) {
            if(Auth::guard('user')->check()) {
                if(Auth::guard('user')->user()->id == $users_id) {
                    Session::put('can_update', true);
                }
            }
            // ==================
    
            // Get User Profile information from users_profiles table
            $profile_overview = UsersProfile::where('handle_name', $slug)->where('profile_id', 7)->first();
            if(!Session::get('can_update')){
                UsersProfile::where('handle_name', $slug)->where('profile_id', 7)->update(['profile_views' => ($profile_overview->profile_views + 1) ]);
            }
            $social_media = UsersProfileSocialMedia::where('users_profiles_id', $profile_overview->id)->pluck('social_media_link', 'social_media')->toArray();
            
            // ==================
            $profile_id = 7;
            $user_profile_id = $profile_overview->id;
    
            return view('frontend.profiles.freelancer_profile')->with('profile_id', $profile_id)->with('user_profile_id', $user_profile_id)->with('social_media', $social_media)->with('can_update', Session::get('can_update'))->with('profile_overview', $profile_overview);

        } else {
            // If no record found then throw 404 error
            abort(404);
        }
    }
    
    public function propertyProfile($slug) {
        // Check whether user can update the content of profile or not
        Session::put('can_update', false);
        $users_id = \General::getUsersID($slug);
        if(!empty($users_id)) {
            if(Auth::guard('user')->check()) {
                if(Auth::guard('user')->user()->id == $users_id) {
                    Session::put('can_update', true);
                }
            }
            // ==================
    
            // Get User Profile information from users_profiles table
            $profile_overview = UsersProfile::where('handle_name', $slug)->where('profile_id', 8)->first();
            if(!Session::get('can_update')){
                UsersProfile::where('handle_name', $slug)->where('profile_id', 8)->update(['profile_views' => ($profile_overview->profile_views + 1) ]);
            }
            $social_media = UsersProfileSocialMedia::where('users_profiles_id', $profile_overview->id)->pluck('social_media_link', 'social_media')->toArray();
            
            // ==================
            $profile_id = 8;
            $user_profile_id = $profile_overview->id;
    
            return view('frontend.profiles.property_profile')->with('profile_id', $profile_id)->with('user_profile_id', $user_profile_id)->with('social_media', $social_media)->with('can_update', Session::get('can_update'))->with('profile_overview', $profile_overview);

        } else {
            // If no record found then throw 404 error
            abort(404);
        }
    }

    public function companyProfile($slug) {
        // Check whether user can update the content of profile or not
        Session::put('can_update', false);
        $users_id = \General::getUsersID($slug);
        if(!empty($users_id)) {
            if(Auth::guard('user')->check()) {
                if(Auth::guard('user')->user()->id == $users_id) {
                    Session::put('can_update', true);
                }
            }
            // ==================
    
            // Get User Profile information from users_profiles table
            $profile_overview = UsersProfile::where('handle_name', $slug)->where('profile_id', 9)->first();
            if(!Session::get('can_update')){
                UsersProfile::where('handle_name', $slug)->where('profile_id', 9)->update(['profile_views' => ($profile_overview->profile_views + 1) ]);
            }
            $social_media = UsersProfileSocialMedia::where('users_profiles_id', $profile_overview->id)->pluck('social_media_link', 'social_media')->toArray();
            
            // ==================
            $profile_id = 9;
            $user_profile_id = $profile_overview->id;
    
            return view('frontend.profiles.company_profile')->with('profile_id', $profile_id)->with('user_profile_id', $user_profile_id)->with('social_media', $social_media)->with('can_update', Session::get('can_update'))->with('profile_overview', $profile_overview);

        } else {
            // If no record found then throw 404 error
            abort(404);
        }
    }
    
    public function marketplace($slug) {
        // Check whether user can update the content of profile or not
        Session::put('can_update', false);
        $users_id = \General::getUsersID($slug);
        if(!empty($users_id)) {
            if(Auth::guard('user')->check()) {
                if(Auth::guard('user')->user()->id == $users_id) {
                    Session::put('can_update', true);
                }
            }
            // ==================
    
            // Get User Profile information from users_profiles table
            $profile_overview = UsersProfile::where('handle_name', $slug)->where('profile_id', 10)->first();
            if(!Session::get('can_update')){
                UsersProfile::where('handle_name', $slug)->where('profile_id', 10)->update(['profile_views' => ($profile_overview->profile_views + 1) ]);
            }
            $social_media = UsersProfileSocialMedia::where('users_profiles_id', $profile_overview->id)->pluck('social_media_link', 'social_media')->toArray();
            
            // ==================
            $profile_id = 10;
            $user_profile_id = $profile_overview->id;
    
            return view('frontend.profiles.marketplace')->with('profile_id', $profile_id)->with('user_profile_id', $user_profile_id)->with('social_media', $social_media)->with('can_update', Session::get('can_update'))->with('profile_overview', $profile_overview);

        } else {
            // If no record found then throw 404 error
            abort(404);
        }
    }

    // Edit profile view code
    public function editProfile(Request $request) {
        if($request->ajax()) {

            $profile_info = UsersProfile::where('id', $request->user_profile)->where('profile_id', $request->profile_id)->first();
            $profile_id = $request->profile_id;
            $user_profile_id = $request->user_profile;
            return view('frontend.profiles.shared.profile_update')->with('profile_id', $profile_id)->with('user_profile_id', $user_profile_id)->with('profile_info', $profile_info);
        }
    }

    public function updateProfile(Request $request) {
        $data = $request->all();
        unset($data['_token']);
        unset($data['profile_id']);
        unset($data['user']);
        if(!empty($data['profession'])) {
            if(is_array($data['profession'])) {
                $data['profession'] = implode(',', $data['profession']);
            }
        }

        if(isset($data['no_of_people_from'])) {
            $data['no_of_people'] = $data['no_of_people_from'] . (!empty($data['no_of_people_to']) ? '-' . $data['no_of_people_to'] : '' ) ;
            unset($data['no_of_people_from']);
            unset($data['no_of_people_to']);
        }

        $profile_info = UsersProfile::where('id', $request->user)->where('profile_id', $request->profile_id)->update($data);
        return redirect()->back();
    }

    // Add NEw profile picture code
    public function editProfilePicture(Request $request) {
        if($request->ajax()) {
            $profile_id = $request->profile_id;
            $user_profile_id = $request->user_profile;
            return view('frontend.profiles.shared.profile_picture')->with('profile_id', $profile_id)->with('user_profile_id', $user_profile_id);
        } else {
            abort(404);
        }
    }

    public function updateProfilePicture(Request $request) {
        if($request->ajax()) {
            UsersProfile::where('id', $request->user)->where('profile_id', $request->profile_id)->update(['profile_pic' => $request->profile_pic]);
            $profile_pic = new UsersProfilePicture();
            $profile_pic->users_profiles_id = $request->user;
            $profile_pic->profile_pic = $request->profile_pic;
            $profile_pic->description = $request->description;
            $profile_pic->created_at = Carbon::now();
            $profile_pic->save();

            return asset('/') . 'uploads/profile_picture/' . $request->profile_pic;
        } else {
            abort(404);
        }
    }

    // Profile overview code start here
    public function getProfileOverview(Request $request) {
        if($request->ajax()) {
            $overview = UsersProfileOverview::where('users_profiles_id', $request->user)->where('profile_id', $request->profile_id)->first();            
            
            $profile_id = $request->profile_id;
            $user_profile_id = $request->user;

            return view('frontend.profiles.shared.profile_overview')->with('profile_id', $profile_id)->with('user_profile_id', $user_profile_id)->with('can_update', Session::get('can_update'))->with('overview', $overview);
        } else {
            abort(404);
        }
    }
    
    public function updateProfileOverview(Request $request) {

        if(!empty($request->interest_id)) {
            UsersProfile::where('id', $request->user)->update(['interest_id' => implode(',', $request->interest_id)]);
        }
        
        $data = $request->all();
        unset($data['_token']);unset($data['profile_id']);unset($data['user']);

        $data['language_id'] = (!empty($request->language_id) ? implode(',', $request->language_id) : '');
        $data['interest_id'] = (!empty($request->interest_id) ? implode(',', $request->interest_id) : '');
        $data['genres'] = (!empty($request->genres) ? implode(',', $request->genres) : '');
        $data['instruments'] = (!empty($request->instruments) ? implode(',', $request->instruments) : '');
        $data['facilities'] = (!empty($request->facilities) ? implode(',', $request->facilities) : '');

        $profile = UsersProfileOverview::updateOrCreate(
            ['users_profiles_id' => $request->user, 'profile_id' => $request->profile_id, 'users_id' => Auth::guard('user')->user()->id ],
            $data
        );
    }
    
    // Profile basic info code start here
    public function getProfileBasicInfo(Request $request) {
        if($request->ajax()) {
            $basic_info = UsersProfileBasicInfo::where('users_profiles_id', $request->user)->where('profile_id', $request->profile_id)->first();
            $profile_id = $request->profile_id;
            $user_profile_id = $request->user;

            return view('frontend.profiles.shared.profile_basic_info')->with('profile_id', $profile_id)->with('user_profile_id', $user_profile_id)->with('can_update', Session::get('can_update'))->with('basic_info', $basic_info);
        } else {
            abort(404);
        }
    }

    public function updateProfileBasicInfo(Request $request) {
        $data = $request->all();
        unset($data['_token']);unset($data['profile_id']);unset($data['user']);

        $basic_info = UsersProfileBasicInfo::updateOrCreate(
                        [ 'users_profiles_id' => $request->user, 'profile_id' => $request->profile_id, 'users_id' => Auth::guard('user')->user()->id ],
                        $data
                    );
    }
    
    public function getProfileImageMedia(Request $request) {
        if($request->ajax()) {
            $profile_id = $request->profile_id;
            $user_profile_id = $request->user;
            return view('frontend.profiles.shared.media.media_image')->with('profile_id', $profile_id)->with('user_profile_id', $user_profile_id)->with('can_update', Session::get('can_update'));
        } else {
            abort(404);
        }
    }
    
    public function getProfileVideoMedia(Request $request) {
        if($request->ajax()) {
            $profile_id = $request->profile_id;
            $user_profile_id = $request->user;
            
            return view('frontend.profiles.shared.media.media_video')->with('profile_id', $profile_id)->with('user_profile_id', $user_profile_id)->with('can_update', Session::get('can_update'));
        } else {
            abort(404);
        }
    }
    public function getProfileAudioMedia(Request $request) {
        if($request->ajax()) {
            $profile_id = $request->profile_id;
            $user_profile_id = $request->user;
            
            return view('frontend.profiles.shared.media.media_audio')->with('profile_id', $profile_id)->with('user_profile_id', $user_profile_id)->with('can_update', Session::get('can_update'));
        } else {
            abort(404);
        }
    }
    
    public function updateProfileMedia(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'media_type' => ['required'],
            'profile_id' => ['required'],
            'users_profiles_id' => ['required'],
        ]); 
        
        if ($validator->fails()) {
            return "error";
        }
        
        $data = $request->all();
        unset($data['_token']);
        
        if($request->media_type == "image_pdf" || $request->media_type == "video") {
            // Upload media
            $extension = $request->file('media')->getClientOriginalExtension();
            $dir = public_path() .'/uploads/portofolio/';
            $filename = uniqid() . '_' . time() . '.' . $extension;
            $var = $request->file('media')->move($dir, $filename);
            
            $data['media'] = $filename;
            $data['media_type'] = $extension;
            
        }
        
        $data['status'] = 1;
        $data['locked'] = 1;
        // print_r($data);exit;
        UsersProfileMedia::Create($data);
        
        return "success";
    }

    public function getProfileMedia(Request $request) {
        if($request->ajax()) {
            $profile_id = $request->profile_id;
            $user_profile_id = $request->user;
            $can_update = Session::get('can_update');
            
            $media = UsersProfileMedia::where('users_profiles_id', $user_profile_id)->where('profile_id', $profile_id)->where('media_location', 0)->where('is_archived', 0)->offset($request->start)->limit($request->limit)->orderByDesc('id')->get();
            $media_count = UsersProfileMedia::where('users_profiles_id', $user_profile_id)->where('profile_id', $profile_id)->where('media_location', 0)->where('is_archived', 0)->count();

            $html = view('frontend.profiles.shared.media.media_display', compact('media', 'profile_id', 'user_profile_id', 'can_update'))->render();
            
            $response = [
                'html' => $html,
                'show_btn' => 'false'
            ];

            if(count($media) > 0) {
                if($media_count > ($request->start + $request->limit)) {
                    $response['show_btn'] = 'true';
                }
            } 

            return \json_encode($response);
        } else {
            about(404);
        }
    }
    
    public function getProfileArchiveMedia(Request $request) {
        if($request->ajax()) {
            $profile_id = $request->profile_id;
            $user_profile_id = $request->user;
            $can_update = Session::get('can_update');
            
            $media = UsersProfileMedia::where('users_profiles_id', $user_profile_id)->where('profile_id', $profile_id)->where('media_location', 0)->where('is_archived', 1)->orderByDesc('id')->get();
            
            $html = view('frontend.profiles.shared.media.media_display', compact('media', 'profile_id', 'user_profile_id', 'can_update'))->render();
            
            $response = [
                'html' => $html,
            ];

            return \json_encode($response);
        } else {
            about(404);
        }
    }

    public function updateSocialMedia(Request $request) {
        $data = $request->all();
        unset($data['_token']);
        foreach ($data['social_media_link'] as $key => $value) {
            if(!empty($value)) {
                UsersProfileSocialMedia::updateOrCreate(
                    [ 'users_profiles_id' => $request->users_profiles_id, 'social_media' => $data['social_media'][$key] ],
                    [ 'social_media_link' => $value]
                );
            } else {
                UsersProfileSocialMedia::where([ 'users_profiles_id' => $request->users_profiles_id, 'social_media' => $data['social_media'][$key] ])->delete();
            }
        }

        return redirect()->back();
    
    }

    public function addMusic(Request $request) {
        if($request->ajax()) {
            $profile_id = $request->profile_id;
            $user_profile_id = $request->user_profile;
            $by = UsersProfile::where('status', 1)->pluck('handle_name', 'id')->toArray();
            return view('frontend.profiles.shared.profile_music_update')->with('by', $by)->with('profile_id', $profile_id)->with('user_profile_id', $user_profile_id)->with('can_update', Session::get('can_update'));
        } else {
            abort(404);
        }
    }
    
    public function editMusic(Request $request) {
        if($request->ajax()) {
            $profile_id = $request->profile_id;
            $user_profile_id = $request->user_profile;
            $by = UsersProfile::where('status', 1)->pluck('handle_name', 'id')->toArray();
            $music = UsersProfileMedia::where('id', $request->media_id)->first();
            
            return view('frontend.profiles.shared.profile_music_update')->with('music', $music)->with('by', $by)->with('profile_id', $profile_id)->with('user_profile_id', $user_profile_id)->with('can_update', Session::get('can_update'));
        } else {
            abort(404);
        }
    }
    
    public function saveMusic(Request $request) {

        $job_mode = 'add';
        if(empty($request->media_id)) {

            $validator = Validator::make($request->all(), [
                'album_cover' => ['required', 'mimes:jpeg,jpg,png'],
                'media' => ['required', 'mimes:mp3'],
                'title' => ['required'],
            ]); 
            
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            
        } else {
            $validator = Validator::make($request->all(), [
                'title' => ['required'],
            ]); 
            
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $job_mode = "edit";
        }

        $data = $request->all();
        unset($data['_token']);
        unset($data['media_id']);

        if($request->media_type == "audio") {
            $update_media = true;
            $update_cover = true;
            if($job_mode == "edit") {
                if(empty($request->media)) {
                    $update_media = false;
                }
                if(empty($request->album_cover)) {
                    $update_cover = false;
                }
            }
            if($update_media) {

                // Upload media
                $extension = $request->file('media')->getClientOriginalExtension();
                $dir = public_path() .'/uploads/portofolio/';
                $filename = uniqid() . '_' . time() . '.' . $extension;
                $var = $request->file('media')->move($dir, $filename);
                
                $data['media'] = $filename;
                $data['media_type'] = $extension;

            } else {
                unset($data['media']);
                unset($data['media_type']);
            }
            
            if($update_cover) {

                $extension = $request->file('album_cover')->getClientOriginalExtension();
                $dir = public_path() .'/uploads/portofolio/';
                $filename = uniqid() . '_' . time() . '.' . $extension;
                $var = $request->file('album_cover')->move($dir, $filename);
                
                $data['album_cover'] = $filename;
                
            } else {
                unset($data['album_cover']);
            }
        }

        $data['album_by'] = !empty($data['album_by'][0]) ? implode(',', $data['album_by']) : Null;
        $data['genres'] = !empty($data['genres'][0]) ? implode(',', $data['genres']) : Null;
        $data['instruments'] = !empty($data['instruments'][0]) ? implode(',', $data['instruments']) : Null;
        $data['keywords'] = !empty($data['keywords'][0]) ? implode(',', array_filter($data['keywords'])) : Null;
        
        $data['status'] = 1;
        
        if($job_mode == "add") {
            UsersProfileMedia::Create($data);
            flash("Music Added Successfully!")->success();
        } else {
            UsersProfileMedia::where('id', $request->media_id)->update($data);
            flash("Music Updated Successfully!")->success();
        }

        return "success";
        // return redirect()->back();

    }

    public function getProfileMusic(Request $request) {

        if($request->ajax()) {
            $profile_id = $request->profile_id;
            $user_profile_id = $request->user;
            $can_update = Session::get('can_update');
            
            $media = UsersProfileMedia::where('users_profiles_id', $user_profile_id)->where('profile_id', $profile_id)->where('media_location', 1)->where('is_archived', 0)->offset($request->start)->limit($request->limit)->get();
            $media_count = UsersProfileMedia::where('users_profiles_id', $user_profile_id)->where('profile_id', $profile_id)->where('media_location', 1)->where('is_archived', 0)->count();
            
            $html = view('frontend.profiles.shared.media.music_display', compact('media', 'profile_id', 'user_profile_id', 'can_update'))->render();
            $response = [
                'html' => $html,
                'show_btn' => 'false'
            ];

            if(count($media) > 0) {
                if($media_count > ($request->start + $request->limit)) {
                    $response['show_btn'] = 'true';
                }
            } 

            return \json_encode($response);
        } else {
            about(404);
        }
    }
    
    public function getVisibleModal(Request $request) {

        if($request->ajax()) {
            $tbl = $request->tbl;
            $media_id = $request->media_id;
            $profile_id = $request->profile_id;
            $user_profile_id = $request->user_profile;
            $curr_visible = $request->curr_visible;
            $visible = Visible::orderBy('id')->get();

            return view('frontend.visible.visible_update')->with('visible', $visible)->with('curr_visible', $curr_visible)
            ->with('profile_id', $profile_id)->with('user_profile_id', $user_profile_id)
            ->with('media_id', $media_id)->with('tbl', $tbl);

        } else {
            about(404);
        }
    }

    public function updateVisible(Request $request) {
        $tbl = '\App\Models\Frontend\\' .$request->tbl;
        $modal =  $tbl::where('id', $request->media_id)->update(['locked' => $request->locked]);
        return $request->locked;
    }

    public function deleteMedia(Request $request) {
        $validator = Validator::make($request->all(), [
            'media_id' => ['required'],
        ]); 
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        UsersProfileMedia::where('id', $request->media_id)->delete();
        flash("Media Deleted Successfully!")->success();   
        
        return redirect()->back();
    }
    
    public function likeMedia(Request $request) {
        if(Auth::guard('user')->check()) {

            $likes = UsersProfileMedia::where('id', $request->media_id)->pluck('likes')->first();
            $response = "true";
            $likes = explode(',', $likes);
            if (($k = array_search(Auth::guard('user')->user()->id, $likes)) !== false) {
                unset($likes[$k]);
                $response = "false";
            } else {
                $likes[0] = Auth::guard('user')->user()->id;
            }
    
            UsersProfileMedia::where('id', $request->media_id)->update(['likes' => implode(',', $likes)]);
            echo $response;
        }        
    }
    
    
    public function playMediaCount(Request $request) {
        // if(Auth::guard('user')->check()) {
            $audio_play_count = UsersProfileMedia::where('id', $request->media_id)->pluck('audio_play_count')->first();
            $cnt = 0;
            
            if($audio_play_count !== null) {
                $cnt = $audio_play_count;
            }
            UsersProfileMedia::where('id', $request->media_id)->update(['audio_play_count' => ($cnt + 1) ]);
            return ($cnt + 1);
        // }
    }

    public function updateFollower(Request $request) {
        $data = $request->all();
        unset($data['_token']);
        Followers::Create($data);
        flash("Following Successfully!")->success();
        return redirect()->back();
    }
    
    public function deleteFollower(Request $request) {
        Followers::where('id', $request->id)->delete();
        flash("Unfollowing Successfully!")->success();
        return redirect()->back();
    }

    public function reportProfile(Request $request) {
        $data = $request->all();
        unset($data['_token']);
        ReportProfile::Create($data);
        flash("Profile reported Successfully!")->success();
        return redirect()->back();
    }

    public function usersReview(Request $request) {
        $reviewer = 0;
        if(Auth::guard('user')->check()) {
            $reviewer = \General::getUserProfileByUserAndProfile(Auth::guard('user')->user()->id, $request->profile_id);
        }

        $review = Review::where('users_profiles_id', $request->users_profiles_id)->get();
        $review_count = Review::where('users_profiles_id', $request->users_profiles_id)->count();
        $html = '';
        foreach ($review as $key => $value) {
            $rating = '';
            for ($i=0; $i < 5; $i++) { 
                if($i < $value->rating) {
                    $rating .= '<i class="fa fa-star fill-star" aria-hidden="true"></i>';
                } else {
                    $rating .= '<i class="fa fa-star-o" aria-hidden="true"></i>';
                }
            }
            $time = Carbon::parse($value->created_at)->diffForHumans();

            $deleteHtml = '';
            if($reviewer == $value->reviewer_users_profile_id) {
                $deleteHtml = '<button type="button" class="transparent-btn delete__review" data-id="'.$value->id.'">
                                   <i class="fa fa-trash-o" aria-hidden="true"></i>
                               </a>';
            }

            $html .= '<div class="row border-bottom review__block__'.$value->id.'">
                <div class="col-md-11">
                    <div class="left-review-panel">
                        <div class="row">
                            <div class="col-md-12 flex-review">
                                <img src="'.asset('/').'uploads/profile_picture/'.$value->getReviewer('profile_pic').'" class="review-img">
                                <div class="content-block">
                                    <p class="review-rating">
                                        '.$rating.'
                                    </p>
                                    <p class="review-time">
                                        '.$time.' by <span class="highlight-box">'.$value->getReviewer('full_name').'</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <p class="review-comment">'.$value->comment.'</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="right-side-panel">
                        '.$deleteHtml.'
                    </div>
                </div>
            </div>';

        }
    
        if(empty($html)) {
            $html = "<p>No reviews!</p>";
        }

        $response = [
            'html' => $html,
            'review_count' => $review_count,
        ];

        return json_encode($response);
    }


    public function addReview(Request $request) {
        if($request->ajax()) {
            $profile_id = $request->profile_id;
            $user_profile_id = $request->user_profile;
         
            return view('frontend.review.add_review')->with('profile_id', $profile_id)->with('user_profile_id', $user_profile_id);

        } else {
            about(404);
        }
    }

    public function updateReview(Request $request) {
        $data = $request->all();
        
        unset($data['_token']);
        unset($data['attachment_url']);

        if ($request->hasFile('attachment')) {

            $extension = $request->file('attachment')->getClientOriginalExtension();
            $dir = public_path() .'/uploads/review/';
            $filename = uniqid() . '_' . time() . '.' . $extension;
            $var = $request->file('attachment')->move($dir, $filename);
            
            $data['attachment'] = $filename;
        } else {
            $data['attachment'] = $request->attachment_url;
        }

        Review::Create($data);
        flash("Review submitted successfully!")->success();
        return redirect()->back();
    }

    public function deleteReview(Request $request) {
        Review::where('id', $request->review_id)->delete();
    }

    public function postComments(Request $request) {
        $data = $request->all();
        
        unset($data['_token']);
        unset($data['user_name']);
        unset($data['tbl']);
        
        $model_class = '\App\Models\Frontend\\' .$request->tbl;
        $comment =  $model_class::create($data);

        $cls = "";
        $parent = $comment->id;
        if(!empty($request->is_reply)) {
            $cls = "innersub-comment";
            $parent = $comment->parent_comment_id;
        }

        $html = '
            <div class="row py-1 px-3 comment__block" id="comment__block__'.$comment->id.'">
                <div class="col-md-10 text-left">
                    <div class="comment-box '.$cls.'">
                        <p class="para-comment line_height"><strong>'.$request->user_name.'</strong>
                            '.$request->comments.'</p>
                        <p class="small-txt para-date-comment line_height">
                            '. Carbon::parse($comment->created_at)->diffForHumans() .'
                        </p>
                        <p class="small-txt reply-txt reply__event" id="replay">Reply</p>
                    </div>
                    <div class="row chat-row-append" style="display: none;">
                        <div class="col-md-10">
                            <input type="text" id="comment_'.$comment->id.'" data-validate="required" placeholder="comment here" class="form-control">
                            <span aria-hidden="true" class="close-btn">&times;</span>
                        </div>
                        <div class="col-md-2">
                            <button type="button" data-tbl="'.$request->tbl.'"  data-parent="'.$parent.'" data-id="'.$comment->id.'" class="btn post-btn reply__comment__btn">Post</button>
                        </div>
        
                    </div>
                </div>
                <div class="col-md-2 text-right">
                    <i class="fa fa-trash-o red-trash delete__comment cursor-pointer" data-id="'.$comment->id.'" aria-hidden="true"></i>
                </div>
            </div>';

        $html .= '<div class="reply__section__'.$comment->id.'"></div>';
        
        if(empty($request->is_reply)) {
            $html .= '<hr>';
        }

        return $html;
    }

    public static function getComments($tbl, $media_id) {
        $cls = '\App\Models\Frontend\\' .$tbl;
        $modal =  $cls::where('users_profile_media_id', $media_id)->where('is_reply', 0)->with('usersProfile')->orderByDesc('id')->get();
        return view('frontend.profiles.shared.comments')->with('comments', $modal)->with('tbl', $tbl)->with('media_id', $media_id);
    }
    
    public function getAllComments(Request $request) {
        $cls = '\App\Models\Frontend\\' .$request->tbl;
        $modal =  $cls::where('users_profile_media_id', $request->media_id)->where('is_reply', 0)->with('usersProfile')->orderByDesc('id')->get();
        return view('frontend.profiles.shared.comments')->with('comments', $modal)->with('tbl', $request->tbl)->with('media_id', $request->media_id);
    }

    public static function getCommentCounts($tbl, $media_id) {
        $tbl = '\App\Models\Frontend\\' .$tbl;
        $modal =  $tbl::where('users_profile_media_id', $media_id)->with('usersProfile')->count();
        return $modal;
    }

    public function deleteComment(Request $request) {
        $cls = '\App\Models\Frontend\\' .$request->tbl;
        $modal =  $cls::where('id', $request->id)->delete();
        $cls::where('reply_comment_id', $request->id)->delete();
        $cls::where('parent_comment_id', $request->id)->delete();
    }


}