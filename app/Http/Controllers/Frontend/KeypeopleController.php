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
use App\Models\Frontend\Users;
use App\Models\Frontend\KeyPeoples;
use App\Models\Frontend\KeyPeopleTitles;
use App\Models\Frontend\KeylistMedia;

class KeypeopleController extends Controller {

    public function index(Request $request) {
        $keypeople = Keypeoples::where('sender_id', Auth::guard('user')->user()->id)->where('status', 1)->with('usersProfile')->get();
        $keypeople_title = KeyPeopleTitles::where('users_id', Auth::guard('user')->user()->id)->get();
        return view('frontend.keypeople.index')->with('keypeople', $keypeople)->with('keypeople_title', $keypeople_title);
    }

    public function add_keypeople_title_modal(Request $request) {
        if($request->ajax()) {
            return view('frontend.keypeople.update_title');
        }
    }

    public function add_keypeople_title(Request $request) {
        if($request->ajax()) {
            $title = $request->title;
            $user_id = Auth::guard('user')->user()->id;
            $validator = Validator::make($request->all(), [
                'title' => [
                    'required',
                    Rule::unique('keypeople_titles')->where(function ($query) use($title, $user_id) {
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

            KeyPeopleTitles::create($data);

            $response = [
                'result' => "true",
            ];
            return \json_encode($response);
        }
    }

    public function updateCategory(Request $request) {
        $data['keypeople_title_id'] = $request->keypeople_title_id;
        $oKeyPeople = KeyPeoples::where('id', $request->keypeople_id)->update($data);
    }
    

    public function sendRequest(Request $request) {
        
        $validatePin = Users::where('pin', $request->pin)->first();
        
        $response = [
            'status' => 400,
            'msg' => 'Invalid Pin!'
        ];

        if(!empty($validatePin)) {
            
            // Save Key people
            $validAlreadyExist = KeyPeoples::where(['sender_id' => $request->sender_id, 'receiver_id' => $request->receiver_id])->first();

            if(empty($validAlreadyExist)) {
                $data = $request->all();
                unset($data['_token']);
                unset($data['pin']);

                //*** Remove nex line after notification work is completed.
                $data['status'] = 1;
                $oKeyPeople = KeyPeoples::create($data);
                
                //*** Remove next line after notification work is completed.
                KeyPeoples::create(['sender_id' => $request->receiver_id, 'receiver_id' => $request->sender_id, 'status' => 1]);
                
                $response = [
                    'status' => 200,
                ];

                //**** uncomment following code to send notification to key people for accept/decline/decline later.
                // Notification Code Start
                // $oNotify = [
                //     'sender_id' => $request->sender_id,
                //     'receiver_id' => $request->receiver_id,
                //     'media_tbl' => 'KeyPeoples',
                //     'media_id' => $oKeyPeople->id,
                //     'media_type' => 'keypeople',
                //     'status' => 1
                // ];
                // \Notification::send($oNotify);
                // Notification Code End

            } else {
                $response = [
                    'status' => 400,
                    'msg' => 'Profile already exist!'
                ];
            }
        } else {
            $response = [
                'status' => 400,
                'msg' => 'Invalid Pin!'
            ];

        }
        echo json_encode($response);

    }

    public function deleteKeypeople(Request $request) {
        
        $sender_id = KeyPeoples::where('sender_id', $request->sender)->where('receiver_id', $request->receiver)->pluck('id')->toArray();
        $receiver_id = KeyPeoples::where('receiver_id', $request->sender)->where('sender_id', $request->receiver)->pluck('id')->toArray();;
        
        KeylistMedia::where('media_id', $sender_id)->where('media_tbl', "KeyPeoples")->delete();
        KeylistMedia::where('media_id', $receiver_id)->where('media_tbl', "KeyPeoples")->delete();

        KeyPeoples::where('sender_id', $request->sender)->where('receiver_id', $request->receiver)->delete();
        KeyPeoples::where('receiver_id', $request->sender)->where('sender_id', $request->receiver)->delete();

        flash("Keypeople deleted successfully!")->success();
        return redirect()->back();
    }
}