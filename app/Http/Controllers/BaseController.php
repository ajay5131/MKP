<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class BaseController extends Controller
{
     public function imageUpload($image_name, $folder='uploads')
    {
        if($image_name){
        $destinationPath = public_path('/'.$folder);

        $logo_name = time().'_'.$image_name->getClientOriginalName();

        if(!file_exists($destinationPath)){
        mkdir($destinationPath,0777,true);
        }

        $image_name->move($destinationPath, $logo_name);
        return $logo_name;
        }
    }

     public function imageDelete($old_image, $folder='uploads')
     {
        $path = public_path('/'.$folder);
        $full_path = $path.'/'.$old_image;

        if(!empty($old_image) && file_exists($full_path) ){
        return unlink($full_path);
        }
     }

     public function sendMail($data){
        $sendermail = 'ajay5131rana@gmail.com';
        $senderName = 'Ajay';
        Mail::send('emails.mail', $data, function($message) use ($data) {
        $message->to($data['email'], $data['name'])
        ->subject($data['msg']);
        $message->from($sendermail,$senderName);
        });
     }
}
