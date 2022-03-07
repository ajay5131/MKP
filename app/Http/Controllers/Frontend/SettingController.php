<?php

namespace App\Http\Controllers\Frontend;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Frontend\Users;
use App\Models\Frontend\UsersProfile;
use Illuminate\Support\Facades\Auth;
use App\Rules\ValidateArrayElement;
use Illuminate\Validation\Rule; 

class SettingController extends Controller {
        
    // Load setting view
    public function index() {
        $main_profile = UsersProfile::where('users_profiles.users_id', \Auth::guard('user')->user()->id)->where('users_profiles.profile_id', 1)
                        ->select('users_profiles.full_name', 'users.email', 'gender', 'dob', 'country_id', 'state_id', 'city_id', 'handle_name', 'interest_id', 'is_private', 'dissociate', 'pin')
                        ->join('users', 'users.id', '=', 'users_profiles.users_id')->first();

        $profiles = UsersProfile::where('users_id', \Auth::guard('user')->user()->id)->where('status', 1)->where('profile_id', '!=', 1)->where('profile_id', '!=', 10)
                        ->pluck('handle_name', 'profile_id')->toArray();

        return view('frontend.setting.index')->with('profile', $main_profile)->with('profiles', $profiles);
    }

    public function update(Request $request) {
        // Update profile by tabs using btn name ("save_btn")
        // Validate 
        if(isset($request->save_btn)) {

            switch ($request->save_btn) {
                case 'general_setting':
                    
                    $handle_name = $request->handle_name;
                    $id = Auth::guard('user')->user()->id;
                    $pin = $request->pin;

                    $validator = Validator::make($request->all(), [
                        'full_name' => ['required'],
                        'gender' => ['required'],
                        'dob' => ['required'],
                        'country_id' => ['required'],
                        'state_id' => ['required'],
                        'city_id' => ['required'],
                        'handle_name' => [
                            'required',
                            Rule::unique('users_profiles')->where(function ($query) use($id,$handle_name) {
                                return $query->where('handle_name', $handle_name)
                                ->where('profile_id', '!=',  1)
                                ->where('users_id', $id);
                            })
                        ],
                        'pin' => [
                            'required',
                            Rule::unique('users')->where(function ($query) use($id,$pin) {
                                return $query->where('pin', $pin)
                                ->where('id', '!=',  $id);
                            })
                        ],
                    ]);
                    
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }

                    $user = Users::where('id', Auth::guard('user')->user()->id)->first();
                    $user->pin = $request->pin;
                    $user->save();

                    $user_profile = UsersProfile::where('users_id', Auth::guard('user')->user()->id)->where('profile_id', 1)->first();
                    $user_profile->full_name = $request->full_name;
                    $user_profile->gender = $request->gender;
                    $user_profile->dob = $request->dob;
                    $user_profile->country_id = $request->country_id;
                    $user_profile->state_id = $request->state_id;
                    $user_profile->city_id = $request->city_id;
                    $user_profile->handle_name = $request->handle_name;
                    $user_profile->save();

                    $msg = \Lang::get('messages.record_updated_successfully');
                    flash($msg)->success();

                    break;
                case 'additional_profile':  
                    
                    $validator = Validator::make($request->all(), [
                        'profile_id' => [new ValidateArrayElement(), 'required'],
                    ]);                    
                    
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }

                    $hndname = implode(',', array_filter($request->handlename));
                    $bDuplicate = false;
                    foreach ($request->profile_id as $key => $value) {

                        $duplicate_handle_name = UsersProfile::where('profile_id', '!=', $value)->where('handle_name', $request->handlename[$value])->first();
                        if(!empty($duplicate_handle_name)) {
                            $bDuplicate = true;
                            break;
                        }
                        
                    }
                    if($bDuplicate) {
                        $msg = \Lang::get('messages.duplicate_handlename_found');
                        flash($msg)->error();
                    } else {

                        foreach ($request->profile_id as $key => $value) {
                            // check profile exist or not . if exist then update the handlename else clone the main profile 
                            $profile_exist = UsersProfile::where('users_id', Auth::guard('user')->user()->id)->where('profile_id', $value)->first();
                            if(!empty($profile_exist)) {
                                $profile_exist->handle_name = $request->handlename[$value];
                                $profile_exist->status = 1;
                                $profile_exist->save();
                            } else {
                                $main_profile = UsersProfile::where('users_id', Auth::guard('user')->user()->id)->where('profile_id', 1)->first();
                                $profiles = $main_profile->replicate();
                                $profiles->profile_id = $value;
                                $profiles->handle_name = $request->handlename[$value];
                                $profiles->status = 1;
                                $profiles->save();
                            }
                        }
    
                        // Deactive profiles
                        $escape_profile = implode(',', $request->profile_id).',1,10';
                        UsersProfile::where('users_id', Auth::guard('user')->user()->id)->whereNotIn('profile_id', explode(',', $escape_profile))->update(['status' => 0]);
    
                        Users::where('id', Auth::guard('user')->user()->id)->update(['dissociate' => 0]);
                        if(isset($request->dissociate)) {
                            $user = Users::where('id', Auth::guard('user')->user()->id)->first();
                            $user->dissociate = $request->dissociate;
                            $user->save();
                        } 
                        $msg = \Lang::get('messages.record_updated_successfully');
                        flash($msg)->success();

                    }

                    break;
                case 'verification_id':
                    
                    $validator = Validator::make($request->all(), [
                        'pic' => ['required', 'mimes:jpeg,jpg,png,JPG,JPEG,PNG'],
                    ]);                    
                    
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }

                    // Upload media
                    $upload_video_link =  $request->file('pic');
                    $extension = $request->file('pic')->getClientOriginalExtension();
                    $dir = public_path() .'/uploads/verification_id/';
                    
                    $filename = uniqid() . '_' . time() . '.' . $extension;
                    $var = $request->file('pic')->move($dir, $filename);

                    $user = Users::where('id', Auth::guard('user')->user()->id)->first();
                    $user->identity_media = $filename;
                    $user->save();
                    $msg = \Lang::get('messages.record_updated_successfully');
                    flash($msg)->success();

                    break;
                case 'match_interest':  
                    $validator = Validator::make($request->all(), [
                        'interest_id' => [new ValidateArrayElement(), 'required'],
                    ]);                    
                    
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }

                    $user_profile = UsersProfile::where('users_id', Auth::guard('user')->user()->id)->where('profile_id', 1)->first();
                    $user_profile->interest_id = implode(',', $request->interest_id);
                    $user_profile->save();

                    $msg = \Lang::get('messages.record_updated_successfully');
                    flash($msg)->success();


                    break;
                case 'security_tab':
                    $validator = Validator::make($request->all(), [
                        'old_password' => ['required'],
                        'password' => ['required_with:confirm_password', 'same:confirm_password', 'min:6', 'max:8'],
                        'confirm_password' => ['required', 'min:6'],
                    ]);                    
                    
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }
                    $old_pass = Users::where('id', Auth::guard('user')->user()->id)->pluck('password')->first();
                    if (Hash::check($request->old_password, $old_pass)) {
                        
                        Users::where('id', Auth::guard('user')->user()->id)->update([ 'password' => Hash::make($request->password) ]);
                        
                        $msg = \Lang::get('messages.record_updated_successfully');
                        flash($msg)->success();

                    } else {
                        $msg = \Lang::get('messages.old_password_does_not_match_to_our_record');
                        flash($msg)->error();         
                    }
                    break;
                case 'private_profile': 
                    
                    Users::where('id', Auth::guard('user')->user()->id)->update(['is_private' => 0]);
                    if(isset($request->is_private)) {
                        $user = Users::where('id', Auth::guard('user')->user()->id)->first();
                        $user->is_private = $request->is_private;
                        $user->save();
                    }

                    $msg = \Lang::get('messages.record_updated_successfully');
                    flash($msg)->success();

                    break;
                
                default:
                    $msg = \Lang::get('messages.invalid_request');
                    flash($msg)->error();         
                    break;
            }

        }   
        return redirect(route('setting'));
    }

    public function uniqueHandlename(Request $request) {
        print_r($request->all());
    }
}