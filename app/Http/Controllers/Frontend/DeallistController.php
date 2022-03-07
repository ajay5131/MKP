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
use App\Models\Frontend\DealList;
use App\Models\Frontend\Projects;
use App\Models\Frontend\UsersProfile;

class DeallistController extends Controller {

    public function index() {

    }


    public function list(Request $request) {
        if($request->ajax()) {
            $deallist = DealList::where('receiver_id', Auth::guard('user')->user()->id)->orderByDesc('id')->get();
            $profile_id = $request->profile_id;
            return view('frontend.deallist.list')->with('profile_id', $profile_id)->with('deallist', $deallist);
        }
    }
    
    public function sendDeal(Request $request) {
        if($request->ajax()) {
            $profile_id = $request->profile_id;
            $user_profile_id = $request->user_profile;
            $projects = Projects::where('users_profiles_id', $user_profile_id)->select('id', 'title')->get();
            $receiver_user = UsersProfile::where('id', $user_profile_id)->pluck('users_id')->toArray();
            
            return view('frontend.deallist.send_deal')->with('receiver_user', $receiver_user[0])->with('user_profile_id', $user_profile_id)->with('profile_id', $profile_id)->with('projects', $projects);
        }
    }
    
    public function saveSendDeal(Request $request) {
        $data = $request->all();
        unset($data['_token']);
        $deal_send = DealList::create($data);
        flash("Deal Proposed Successfully!")->success();
        return redirect()->back();
    
    }

    public function replyDeal(Request $request) {
        if($request->ajax()) {
            $deal = DealList::where('id', $request->deal_id)->first();            
            return view('frontend.deallist.reply_deal')->with('deal', $deal);
        }
    }

    public function saveReplyDeal(Request $request) {
        $data["status"] = 2;
        if($request->reply_btn == "accept") {
            $data["status"] = 3;    
        } else if($request->reply_btn == "decline") {
            $data["status"] = 4;
            $data["decline_reason"] = $request->decline_reason;
        } 

        DealList::where('id', $request->media)->update($data);

        flash("Deal Replied Successfully!")->success();
        return redirect()->back();
    }
    
}