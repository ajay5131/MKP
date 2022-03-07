<?php

namespace App\Http\Controllers\Frontend;

use DB;
use App;
use Session;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Frontend\UsersProfilePicture;
use App\Models\Frontend\UsersProfileMedia;
use App\Models\Frontend\KeyPeoples;
use App\Models\Frontend\UsersProfile;

class MediaPopupController extends Controller {
    
    public function loadMedia(Request $request) {
        $modal_name = '\App\Models\Frontend\\' . $request->tbl;
        
        $media_detail = $modal_name::where('id', $request->media_id)->first();
        $can_update = Session::get('can_update');
        
        $keypeoples = KeyPeoples::where('keypeoples.sender_id', $media_detail->users_id)->where('keypeoples.status', 1)->join('users_profiles', 'users_profiles.users_id', '=', 'keypeoples.receiver_id')->where('users_profiles.profile_id', 1)->select('full_name', 'keypeoples.receiver_id', 'users_profiles.handle_name')->get();
        if($request->tbl == "UsersProfilePicture") {
            $user_id = \General::getUserByProfileAndUserProfile($request->user_profile_id, $request->profile_id);
            $keypeoples = KeyPeoples::where('keypeoples.sender_id', $user_id)->where('keypeoples.status', 1)->join('users_profiles', 'users_profiles.users_id', '=', 'keypeoples.receiver_id')->where('users_profiles.profile_id', 1)->select('full_name', 'keypeoples.receiver_id', 'users_profiles.handle_name')->get();
        } 
        
        $comments = ProfilesController::getComments("UsersProfileMediaComments", $request->media_id);
        $comment_count = ProfilesController::getCommentCounts("UsersProfileMediaComments", $request->media_id);
        $comment_tbl = "UsersProfileMediaComments";

        if($request->tbl == "UsersProfilePicture") {
            $comments = ProfilesController::getComments("UsersProfilePictureComments", $request->media_id);
            $comment_count = ProfilesController::getCommentCounts("UsersProfilePictureComments", $request->media_id);
            $comment_tbl = "UsersProfilePictureComments";
        }

        return view('frontend.media_popup.media_detail')->with('comment_tbl', $comment_tbl)->with('comment_count', $comment_count)->with('comments', $comments)->with('keypeoples', $keypeoples)->with('tbl', $request->tbl)->with('can_update', $can_update)->with('profile_id', $request->profile_id)->with('user_profile_id', $request->user_profile_id)->with('media_detail', $media_detail);
    }

    public function archiveMedia(Request $request) {
        if(Auth::guard('user')->check()) {
            $modal_name = '\App\Models\Frontend\\' . $request->tbl;
        
            $media_detail = $modal_name::where('id', $request->media_id)->update(['is_archived' => ($request->status == 0 ? 1 : 0) ]);
        }        
    }

    public function deleteMedia(Request $request) {
        if(Auth::guard('user')->check()) {
            $modal_name = '\App\Models\Frontend\\' . $request->tbl;
        
            if($request->tbl == "UsersProfilePicture") {
                $media_detail = $modal_name::where('id', $request->media_id)->first();
                UsersProfile::where('id', $media_detail->users_profiles_id)->update(['profile_pic' => 'default.png']);
            }

            $media_detail = $modal_name::where('id', $request->media_id)->delete();
        }        
        return redirect()->back();
    }

    public function updateProfileMediaDescription(Request $request) {
        $modal_name = '\App\Models\Frontend\\' . $request->tbl;
        
        $media_detail = $modal_name::where('id', $request->media_id)->update(['description' => $request->description]);
    }

    public function searchMediaLocation(Request $request) {
        $result = DB::select('call search_city_state_country(?)', array($request->q));
        $response = [
            'items' => $result
        ];
        
        echo json_encode($response);
    }
    
    public function updateMediaLocation(Request $request) {
        $modal_name = '\App\Models\Frontend\\' . $request->tbl;
        
        $media_detail = $modal_name::where('id', $request->media_id)->update(['location_id' => $request->location_id ]);
    }

    public function likeMedia(Request $request) {
        if(Auth::guard('user')->check()) {
            $modal_name = '\App\Models\Frontend\\' . $request->tbl;

            $likes = $modal_name::where('id', $request->media_id)->pluck('likes')->first();
            $response = "true";
            $likes = explode(',', $likes);
            if (($k = array_search(Auth::guard('user')->user()->id, $likes)) !== false) {
                unset($likes[$k]);
                $response = "false";
            } else {
                if(empty($likes[0])) {
                    $likes[0] = Auth::guard('user')->user()->id;
                } else {
                    $likes[] = Auth::guard('user')->user()->id;
                }
            }
    
            $modal_name::where('id', $request->media_id)->update(['likes' => implode(',', $likes)]);
            echo $response;
        }        
    }

    public function updateMediaTaggedUser(Request $request) {
        $modal_name = '\App\Models\Frontend\\' . $request->tbl;
        $tagged_user = '';
        if(!empty($request->tag_user_ids)) {
            $tagged_user = implode(',', $request->tag_user_ids);
        }
        $media_detail = $modal_name::where('id', $request->media_id)->update(['tag_user_ids' => $tagged_user ]);
    }
}