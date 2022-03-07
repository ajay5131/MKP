<?php

namespace App\Http\Controllers\Publichome;
use App;
use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Models\Frontend\Users;
use App\Models\Frontend\UsersProfile;
use App\Models\Frontend\UsersProfilePicture;
use App\Models\Frontend\UsersProfileOverview;
use App\Rules\ValidateArrayElement;
use Carbon\Carbon;

class RegisterController extends Controller
{

    use RegistersUsers;

    public function __construct()
    {
        
    }

    public function index() {

        $breadcrumbs = [
            'type' => 'register',
            'title' => \Lang::get('messages.registerbtn'),
            'breadcrumbs' => '<span class="sub-heading-span">Infuse your life with action !</span>',
        ];
        return view('public.register.index')->with('breadcrumbs', $breadcrumbs);
    }

    public function save(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'who_are_you' => ['required'],
            'full_name' => ['required'],
            'email' => ['required', 'email'], //'unique:users'
            'password' => ['required'],
            'how_did_you_hear_about' => ['required'],
            'dob' => ['required'],
            'interest_id' => [new ValidateArrayElement(), 'required'],
            'gender' => ['required'],
            'country_id' => ['required'],
            'state_id' => ['required'],
            'city_id' => ['required'],
            'handle_name' => ['required', 'unique:users_profiles'],
            'profile_pic' => ['required']
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        
        $user = new Users();
        $user->user_role_id = 2;
        $user->who_are_you = $request->who_are_you;
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->profile_id = implode(',', $request->profile_id);
        $user->how_did_hear_about_us = $request->how_did_you_hear_about;
        $user->how_did_hear_about_us_other = $request->how_did_hear_about_us_other;
        $user->pin = $request->pin;
        $user->sponsor_id = $request->sponsor_id;

        $user->save();

        $profiles = $request->profile_id;
        foreach ($profiles as $key => $value) {

            $user_profile = new UsersProfile();
            $user_profile->users_id = $user->id;
            $user_profile->profile_id = $value;
            $user_profile->full_name = $request->full_name;
            $user_profile->interest_id = implode(',', $request->interest_id);
            $user_profile->gender = $request->gender;
            $user_profile->dob = $request->dob;
            $user_profile->country_id = $request->country_id;
            $user_profile->state_id = $request->state_id;
            $user_profile->city_id = $request->city_id;
            $user_profile->handle_name = (($value == 1)  ? $request->handle_name : $request->handle_name .'_'. rand(1, 1000));
            $user_profile->profile_pic = $request->profile_pic;
            $user_profile->status = 1;
            $user_profile->save();
            
            $profile_pic = new UsersProfilePicture();
            $profile_pic->users_profiles_id = $user_profile->id;
            $profile_pic->profile_pic = $request->profile_pic;
            $profile_pic->created_at = Carbon::now();
            $profile_pic->save();
            
            $user_overview = new UsersProfileOverview();
            $user_overview->profile_id = $value;
            $user_overview->users_profiles_id = $user_profile->id;
            $user_overview->users_id = $user->id;
            $user_overview->interest_id = implode(',', $request->interest_id);
            $user_overview->save();
            
        }

        $user->sendEmailVerificationNotification();

        $msg = \Lang::get('messages.verification_email_sent');
        flash($msg)->success();

        return $this->registered($request, $user) ?: redirect(route('home'));
    } 

    public function verifyEmail(Request $request) {
               
        $user = Users::where('id', $request->id)->first();
        if(!empty($user) && $user->email_verification == 1) {
            $msg = \Lang::get('messages.already_verified_email');
        } else if(!empty($user)){
            
            $today = date('Y-m-d H:i:s');   
            
            $created_at = $user->created_at;
            $hourdiff = round((strtotime($today) - strtotime($created_at))/3600, 1);
            
            if($hourdiff>48){
                $msg = \Lang::get('messages.link_expired');
            } else {
                $user->markEmailAsVerified();
                Users::where('id', $request->id)->update(['email_verification' => 1]); 
                $msg = \Lang::get('messages.email_verified_successfully');       
            }
        } else {
            $msg = \Lang::get('messages.link_expired');
        }
        
        flash($msg)->success();
        return redirect(route('home'));
    }

}