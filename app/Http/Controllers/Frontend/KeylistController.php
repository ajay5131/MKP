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
use App\Models\Frontend\KeylistTitles;
use App\Models\Frontend\KeylistMedia;

class KeylistController extends Controller {

    public function index() {
        $keylist_title = KeylistTitles::where('users_id', Auth::guard('user')->user()->id)->get();
        $keylist_title_ids = KeylistTitles::where('users_id', Auth::guard('user')->user()->id)->pluck('id')->toArray();
        $keylist_raw = KeylistMedia::whereIn('keylist_title_id', $keylist_title_ids)->get();
        
        $keylist = $keylist_raw->groupBy('keylist_title_id');
        
        return view('frontend.keylist.index')->with('keylist_title', $keylist_title)->with('keylist', $keylist);
    }

    public function add_keylist_title_modal(Request $request) {
        if($request->ajax()) {
            return view('frontend.keylist.update_title');
        }
    }
    
    public function edit_keylist_title_modal(Request $request) {
        if($request->ajax()) {
            $keylist_title = KeylistTitles::where('id', $request->list_id)->first();
            return view('frontend.keylist.update_title')->with('keylist_title', $keylist_title);
        }
    }

    public function add_to_keylist(Request $request) {
        if($request->ajax()) {
            $keylist = KeylistTitles::where('users_id', Auth::guard('user')->user()->id)->get();
            $profile_id = $request->profile_id;
            $media_id = $request->user_profile;
            $media_type = $request->media_type;
            return view('frontend.keylist.shared.add_keylist')->with('media_type', $media_type)->with('profile_id', $profile_id)->with('media_id', $media_id)->with('keylist', $keylist);
        }
    }
    
   

    public function add_keylist_title(Request $request) {
        if($request->ajax()) {
            $title = $request->title;
            $user_id = Auth::guard('user')->user()->id;
            $validator = Validator::make($request->all(), [
                'title' => [
                    'required',
                    Rule::unique('keylist_titles')->where(function ($query) use($title, $user_id) {
                        return $query->where('title', $title)
                        ->where('users_id', $user_id);
                    })
                ],
            ]);

            if ($validator->fails()) {
                return \json_encode($validator->messages());
            }
            $data = $request->all();
            $data['users_id'] = $user_id;
            unset($data['_token']);

            KeylistTitles::create($data);
            $list = $this->list_keylist_title();
            $response = [
                'result' => "true",
                'keylists' => $list
            ];
            return \json_encode($response);
        }
    }
    
    public function edit_keylist_title(Request $request) {
        if($request->ajax()) {
            
            $title = $request->title;
            $user_id = Auth::guard('user')->user()->id;
            $id = $request->list_id;

            $validator = Validator::make($request->all(), [
                'title' => [
                    'required',
                    Rule::unique('keylist_titles')->where(function ($query) use($title, $user_id, $id) {
                        return $query->where('title', $title)
                        ->where('users_id', $user_id)
                        ->where('id', '!=', $id);
                    })
                ],
            ]);

            if ($validator->fails()) {
                return \json_encode($validator->messages());
            }
            $data = $request->all();
            $data['users_id'] = $user_id;
            unset($data['_token']);
            unset($data['list_id']);

            KeylistTitles::where('id', $request->list_id)->update($data);

            $response = [
                'result' => "true",
            ];
            return \json_encode($response);
        }
    }


    public function deleteKeylist(Request $request) {
        KeylistTitles::where('id', $request->list_id)->delete();
        KeylistMedia::where('keylist_title_id', $request->list_id)->delete();
        flash("Record Deleted Successfully!")->success();
        return redirect()->back();
    }
    
    public function deleteKeylistMedia(Request $request) {
        KeylistMedia::where('id', $request->list_id)->delete();
        flash("Record Deleted Successfully!")->success();
        return redirect()->back();
    }

    public function save_to_keylist(Request $request) {
        $data = $request->all();
        unset($data['_token']);
        KeylistMedia::create($data);
        return "true";
    }


    private function list_keylist_title() {
        $keylist = KeylistTitles::where('users_id', Auth::guard('user')->user()->id)->get();
        $html = '';
        if(!empty($keylist)) {
        
            foreach ($keylist as $key => $value) {
                
                $html .= '<div class="form-check text-left check-field-center">
                    <input class="form-check-input" type="radio" name="keylist_title_id" id="keylist_'.$value->id.'" value="'.$value->id.'">
                    <label class="form-check-label" for="keylist_'.$value->id.'">
                        '. $value->title .'
                    </label>
                </div>';
            }
        }
        return $html;
    }

    
    public function addPinMedia(Request $request) {
        if($request->ajax()) {
            $list_id = $request->list_id;
            return view('frontend.keylist.update_pin')->with('list_id', $list_id);
        }
    }

    public function savePinMedia(Request $request) {
        $data = $request->all();
        unset($data['_token']);
        unset($data['list_id']);
        KeylistMedia::where('id', $request->list_id)->update($data);
        $response = [
            'text' => $data['pin'],
            'color' => $data['pin_bg_color']
        ];

        return \json_encode($response);

    }

}