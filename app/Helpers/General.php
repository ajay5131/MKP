<?php 

namespace App\Helpers;
use DB;
use App\Models\Backend\Language;
use App\Models\Backend\PagesDetail;
use App\Models\Backend\Country;
use App\Models\Backend\City;
use App\Models\Backend\State;
use App\Models\Frontend\Interest;
use App\Models\Frontend\Profiles;
use App\Models\Frontend\ProfileProfession;
use App\Models\Frontend\UsersProfile;
use App\Models\Frontend\Nationality;
use App\Models\Frontend\Followers;
use App\Models\Frontend\Review;
use App\Models\Frontend\UsersProfilePicture;
use App\Models\Frontend\Messages;
use App\User;

class General {
    
    public static function getActiveLanguage(){
        $languages = Language::where('status', 1)->orderBy('language')->get();
        return $languages;
    }
    public static function getAllLanguage() {
        $languages = Language::orderBy('language')->pluck('language as title', 'id')->toArray();
        return $languages;
    }
    
    public static function getAllNationality() {
        $nationality = Nationality::orderBy('title')->pluck('title', 'id')->toArray();
        return $nationality;
    }
    
    public static function getAllCountry() {
        $country = Country::orderBy('title')->pluck('title', 'id')->toArray();
        return $country;
    }
    
    public static function getPageDetail($id) {
        $lang_detail = PagesDetail::where('page_contents_id', $id)->get();
        return $lang_detail;
    }

    public static function getAllInterest() {
        $int = Interest::orderBy('title')->pluck('title', 'id')->toArray();
        return $int;       
    }
    
    public static function getAllInterestImages() {
        $int = Interest::pluck('image', 'id')->toArray();
        return $int;       
    }

    public static function getLocation($location_id) {
        $raw_location = explode("|", $location_id);
        
        switch($raw_location[1]) {
            case 'state' :
                $location = State::where('id', $raw_location[0])->first();
                return $location->title;        
                break;
            case 'city' :
                $location = City::where('city.id', $raw_location[0])->select(DB::raw("concat(city.title, ', ', state.title ,', ', countries.title) as title"))->join('state', 'state.id', '=', 'city.state_id')->join('countries', 'countries.id', '=', 'state.country_id')->first();
                return $location->title;        
                break;
            case 'country' :
                $location = Country::where('id', $raw_location[0])->first();
                return $location->title;
                break;
        }
        
    }

    public static function getProfilePicMediaId($user_profile_id, $img_name = null) {
        $pic = UsersProfilePicture::where('users_profiles_id', $user_profile_id)->orderByDesc('created_at')->limit(1)->first();
        if(!empty($pic)) {
            return $pic->id;
        } else {
            $data = [
                'users_profiles_id' => $user_profile_id,
                'profile_pic' => $img_name
            ];
            $getId = UsersProfilePicture::create($data);
            return $getId->id;
        }
    
    }
    
    public static function getAllHandleName() {
        $handle_names = UsersProfile::where('status', 1)->select('handle_name', 'id')->get();
        return $handle_names;       
    }
    
    public static function getAllProfile() {
        $int = Profiles::where('is_visible', 1)->pluck('title', 'id')->toArray();
        return $int;       
    }
    
    public static function getProfiles() {
        $int = Profiles::pluck('title', 'id')->toArray();
        return $int;       
    }
    public static function getAllProfileProfessionByProfile($profile_id) {
        $int = ProfileProfession::where('profile_id', $profile_id)->orderBy('profession')->pluck('profession', 'id')->toArray();
        return $int;       
    }

    public static function getActiveProfileCount($user_id) {
        $res = UsersProfile::where('users_id', $user_id)->where('status', 1)->count();
        return $res;
    }
    
    public static function getUsersID($handle_name) {
        if(!empty($handle_name)) {
            $res = UsersProfile::where('handle_name', $handle_name)->where('status', 1)->pluck('users_id')->toArray();
            return $res[0];
        } else {
            return "";
        }
    }
    
    public static function getUserByProfileAndUserProfile($user_profile_id, $profile_id) {
        $res = UsersProfile::where('id', $user_profile_id)->where('profile_id', $profile_id)->pluck('users_id')->toArray();
        return $res[0];
    }
    
    public static function getUserProfileByUserAndProfile($users_id, $profile_id) {
        $res = UsersProfile::where('users_id', $users_id)->where('profile_id', $profile_id)->pluck('id')->toArray();
        return $res[0];
    }
    
    public static function getUserProfilePicByUserAndProfile($users_id, $profile_id) {
        $res = UsersProfile::where('users_id', $users_id)->where('profile_id', $profile_id)->pluck('profile_pic')->toArray();
        print_r($res);exit;
        return $res[0];
    }
    
    public static function getMainProfileHandleName($users_id) {
        $res = UsersProfile::where('users_id', $users_id)
                            ->where('profile_id', 1)
                            ->select('handle_name')->first();
        return $res->handle_name;
    }
    
    public static function getUserProfiles($users_id) {
        $res = UsersProfile::where('users_id', $users_id)->where('status', 1)
                            ->join('profiles', 'profiles.id', '=', 'users_profiles.profile_id')
                            ->select('users_profiles.id as users_profiles_id', 'users_profiles.full_name', 'users_profiles.profile_id', 'users_profiles.profile_pic', 'profiles.title as profile_name', 'handle_name')
                            ->orderBy('profile_id', 'ASC')->get();
        return $res;
    }
    
    public static function getUserProfilesIdFromUser($users_id) {
        $res = UsersProfile::where('users_id', $users_id)->where('status', 1)
                            ->pluck('users_profiles.id')
                            ->toArray();
        return $res;
    }

    public static function getInterestImagesById($interest_id) {
        $int = Interest::whereIn('id', explode(',', $interest_id))->select('title', 'image', 'id')->get();
        $html = '';
        foreach ($int as $key => $value) {
            $html .= '<div class="text-center mr-2 ml-2">
                        
                            <img src="'. asset('/') .'home/images/icons/'. $value->image .'" class="img-src-icon">
                            <p class="matching_int_text">'.$value->title .'</p>
                        
                    </div>';
        }
        return $html;
    }

    public static function isFollowing($follower_user_profile_id, $users_id) {
        $res = UsersProfile::where('users_id', $users_id)->where('status', 1)
                            ->pluck('id')
                            ->toArray();
        
        $isFollowing = Followers::where('users_profiles_id', $follower_user_profile_id)->whereIn('follower_users_profiles_id', $res)->pluck('id')->toArray();
        if(!empty($isFollowing)) {
            return $isFollowing[0];
        }

        return 0;

    }

    public static function isReviewWritten($users_profiles_id, $reviewer_users_profile_id, $profile_id ) {
        $reviewer = General::getUserProfileByUserAndProfile($reviewer_users_profile_id, $profile_id);
        $review = Review::where('users_profiles_id', $users_profiles_id)->where('reviewer_users_profile_id', $reviewer)->first();
        if(!empty($review)) {
            return true;
        }
        return false;
    }
    
    public static function countReview($users_profiles_id) {
        $review = Review::where('users_profiles_id', $users_profiles_id)->count();
        return $review;
    }
    
    public static function ratingReview($users_profiles_id) {
        $review = Review::where('users_profiles_id', $users_profiles_id)->select(DB::raw('sum(rating)  as rating'), DB::raw('count(id) as cnt'))->first();
        
        if(!empty($review->rating)) {
            return number_format($review->rating / $review->cnt, 1, ".", "");
        }
        return 0;
    }

    public static function countFollower($users_profiles_id) {
        $followers = Followers::where('users_profiles_id', $users_profiles_id)->count();
        return $followers;
    }

    public static function countMatchingInterest($sender, $reviewer) {
        $interests = UsersProfile::whereIn('users_id', [$sender, $reviewer])->where('profile_id', 1)->pluck('interest_id')->toArray();
        if(!empty($interests)) {
            return count( array_intersect( explode(',', $interests[0]), explode(',', $interests[1]) ) );
        }
        return 0;
    }

    public static function getRplyComments($tbl, $media_id, $comment_id) {
        $tbl = '\App\Models\Frontend\\' .$tbl;
        $modal =  $tbl::where('users_profile_media_id', $media_id)->where('is_reply', 1)
                      ->where(function($q) use ($comment_id) {
                          $q->orWhere('reply_comment_id', $comment_id);
                          $q->orWhere('parent_comment_id', $comment_id);
                      })
                      ->with('usersProfile')->orderBy('id', 'ASC')->get();
        return $modal;
    }

    // User to profile 

    public static function getParticularUserProfile($profile_id) {
        $int = Profiles::where('is_visible', 1)->whereIn('id', $profile_id)
              ->pluck('title', 'id')->toArray();
        return $int;       
    }

    public static function getSingleRow($table, $field, $id, $whr='id') {
        $result = DB::table($table)->where($whr, $id)->first();
        if(!empty($result)) { 
            return $result->$field;
        } else {
            return "";
        }
    }

    public static function getUserName(){
        $res = UsersProfile::where('status', 1)->groupBy('users_id')->get();
        return $res;
    }

    public static function getUserDetail($user_id) {
        $users = UsersProfile::find($user_id);
        return $users;
    }

    public static function getLastMsg($to_id, $from_id) {
        $last_msg = Messages::where(function ($query) use ($to_id, $from_id) {
            $query->where('sender_id', $to_id)
                  ->where('receiver_id', $from_id)
                  ->where('is_group_msg', 0);
        })->orWhere(function ($query) use ($to_id, $from_id) {
            $query->where('sender_id', $from_id)
                  ->where('receiver_id', $to_id)
                  ->where('is_group_msg', 0);
        })->orderBy('created_at','desc')->first();
        return $last_msg;
    }

    public static function getMsgCount($to_id, $from_id) {
        $msgs = Messages::where(function ($query) use ($to_id, $from_id) {
            $query->where('sender_id', $to_id)
                  ->where('receiver_id', $from_id)
                  ->where('is_group_msg', 0);
        })->orWhere(function ($query) use ($to_id, $from_id) {
            $query->where('sender_id', $from_id)
                  ->where('receiver_id', $to_id)
                  ->where('is_group_msg', 0);
        })->count();
        return $msgs;
    }
    public static function getGroupLastMsg($group_id) {
        $last_msg = Messages::where('group_id', $group_id)->orderBy('created_at','desc')->first();
        return $last_msg;
    }

    public static function getGroupMsgCount($group_id) {
        $last_msg = Messages::where('group_id', $group_id)->orderBy('created_at','desc')->count();
        return $last_msg;
    }

    public static function getDeletedGroupMsgCount($group_id, $u_id) {
        $last_msg = Messages::where('group_id', $group_id)->where('deleted_by', 'REGEXP', $u_id)->orderBy('created_at','desc')->count();
        // print_r($last_msg);exit;
        return $last_msg;
    }

    public static function getDeletedMsgCount($to_id, $from_id) {
        $msgs = Messages::where(function ($query) use ($to_id, $from_id) {
            $query->where('sender_id', $to_id)
                  ->where('receiver_id', $from_id)
                  ->where('is_group_msg', 0)
                  ->where('deleted_by', 'REGEXP', $to_id);
            })->orWhere(function ($query) use ($to_id, $from_id) {
                $query->where('sender_id', $from_id)
                ->where('receiver_id', $to_id)
                ->where('is_group_msg', 0)
                ->where('deleted_by', 'REGEXP', $to_id);
        })->count();
        return $msgs;
    }

    public static function getUsers($users, $except_user) {
        $user = UsersProfile::whereIn('users_id', explode(',', $users))->where('users_id', '!=', $except_user)->pluck('name')->toArray();
        return implode(", ", $user);
    }

    public static function getCompensation($id){
           
        if($id == 1){
           $comp = "Collaboration"; 
        }else if($id == 2){
            $comp = "Expenses Only";
        }else{
            $comp = "Paid";
        }
        return $comp;
    }
}