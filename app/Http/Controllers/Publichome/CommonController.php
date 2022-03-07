<?php

namespace App\Http\Controllers\Publichome;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\State;
use App\Models\Backend\City;
use App\Models\Frontend\Users;
use App\Models\Frontend\UsersProfile;

class CommonController extends Controller {

    public function getState(Request $request) {
        $data='<option value="" selected>Select State</option>';
        $states = State::where('country_id',$request->country_id)->select('id','title')->orderBy('title')->get();
        foreach ($states as $value) {
            $data .= "<option value='$value->id'>$value->title</option>";
        }
        return $data;
    }
    
    public function getCity(Request $request) {
        $data='<option value="" selected>Select City</option>';
        $cities = City::where('state_id',$request->state_id)->select('id','title')->orderBy('title')->get();
        foreach ($cities as $value) {
            $data .= "<option value='$value->id'>$value->title</option>";
        }
        return $data;
    }

    public function uniqueEmail(Request $request) {
        $user = Users::where('email', $request->email)->where('user_role_id', 2)->first();
        if(!empty($user)) {
            return "true";
        }
        return "false";
    }
    
    public function uniqueHandleName(Request $request) {
        $user = UsersProfile::where('handle_name', $request->handle_name)->first();
        if(!empty($user)) {
            return "true";
        }
        return "false";
    }

    
    public function uploadProfilePicture(Request $request) {
            $upload_path = public_path() . '/uploads/profile_picture/';
            $data = $request->image;
            $image_array_1 = explode(";", $data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            $imageName = time() . '.png';
            file_put_contents($upload_path . $imageName, $data);
            
            $response = [
                "img_name" => $imageName,
                "img" => '<img src="'.asset('/').'uploads/profile_picture/'.$imageName.'" class="img-thumbnail" />'
            ];
            echo json_encode($response);
    }
}