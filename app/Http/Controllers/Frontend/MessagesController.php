<?php

namespace App\Http\Controllers\Frontend;

use App;
use Session;
use DB;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Rules\ValidateArrayElement;
use Illuminate\Validation\Rule; 
use App\Models\Frontend\UsersProfile;
use App\Models\Frontend\Messages;
use App\Models\Frontend\MessagesMedia;

class MessagesController extends Controller {

    public function index(Request $request)
    {
        $messages = Messages::where('messages.sender_id', \Auth::guard('user')->user()->id)
                            ->orWhere('messages.receiver_id', \Auth::guard('user')->user()->id)->first();
        // print_r($messages->id); die();
        if($messages != NULL){            
            if(\Auth::guard('user')->user()->id === $messages->sender_id){
                $messages = Messages::where('messages.sender_id', \Auth::guard('user')->user()->id)
                                ->orWhere('messages.receiver_id', \Auth::guard('user')->user()->id)
                                ->select('*')
                                ->join('users_profiles', 'users_profiles.users_id', '=', 'messages.receiver_id')->groupBy('users_id')->get();
            }else{
                $messages = Messages::where('messages.sender_id', \Auth::guard('user')->user()->id)
                                ->orWhere('messages.receiver_id', \Auth::guard('user')->user()->id)
                                ->select('*')
                                ->join('users_profiles', 'users_profiles.users_id', '=', 'messages.sender_id')->groupBy('users_id')->get();
            }
        }else{
            $messages = Messages::where('messages.sender_id', \Auth::guard('user')->user()->id)
                                ->orWhere('messages.receiver_id', \Auth::guard('user')->user()->id)
                                ->select('*')
                                ->join('users_profiles', 'users_profiles.users_id', '=', 'messages.receiver_id')->groupBy('users_id')->get();
        }

        return view('frontend.messages.message-list', ['messages' => $messages]);
    }

    public function chatDetails($id, $type)
    {
        $typ = base64_decode($type);
        $user_id = $id;
        $logged_id = Auth::guard('user')->user()->id;
        
        // $user_exists = KeyPeople::where(function($q) use ($user_id, $logged_id) {
        //     $q->where('user_id', $user_id);
        //     $q->where('key_people_user_id', $logged_id);
        // })->orWhere(function($q) use ($user_id, $logged_id) {
        //     $q->where('user_id', $logged_id);
        //     $q->where('key_people_user_id', $user_id);
        // })->pluck('user_id')->first();
        $messages = Messages::where('messages.sender_id', \Auth::guard('user')->user()->id)
                            ->orWhere('messages.receiver_id', \Auth::guard('user')->user()->id)->first();
        $chat_history;
        $bAdmin = false;
        if($typ == "1") {
            $chat_history = Messages::where('group_id', $user_id)->get();
        } else {
            if($logged_id === $user_id){
                // die('IF');
                $chat_history = Messages::where('messages.sender_id', \Auth::guard('user')->user()->id)
                                ->orWhere('messages.receiver_id', \Auth::guard('user')->user()->id)
                                ->Where('messages.subject', $messages->subject)
                                ->select('*')
                                ->join('users_profiles', 'users_profiles.users_id', '=', 'messages.receiver_id')->groupBy('messages.id')->get();
            }else{
                // die('ELSE');
                $chat_history = Messages::where('messages.sender_id', \Auth::guard('user')->user()->id)
                                ->orWhere('messages.receiver_id', \Auth::guard('user')->user()->id)
                                ->Where('messages.subject', $messages->subject)
                                ->select('*')
                                ->join('users_profiles', 'users_profiles.users_id', '=', 'messages.sender_id')->groupBy('messages.id')->get();
            }

            $getAttachment = MessagesMedia::where('messages_id', $id)->get()->toArray();
                            $attachmentHtml = '';
                            if(!empty($getAttachment)) {
                                foreach ($getAttachment as $keyAttach => $valAttach) {
                                    $attachmentHtml = $attachmentHtml . '<a href="'. config('app.app_url') .'uploads/message_attachments/'. $valAttach['attachment'] .'" target="_blank">'. $valAttach['attachment'] .'</a>';
                                }
                            }
        }

        return view('frontend.messages.message-chat', ['chat_history' => $chat_history]);
        // $html = '';
        // foreach ($chat_history as $key => $value) {
        //     if(!in_array(Auth::guard('company')->user()->id, explode(',', $value->deleted_by))) {

        //         if($value->from_admin) {
        //             $bAdmin = true;
        //         }
        //         $getAttachment = MessageAttachments::where('message_id', $value->id)->get()->toArray();
        //         $attachmentHtml = '';
        //         if(!empty($getAttachment)) {
        //             foreach ($getAttachment as $keyAttach => $valAttach) {
        //                 $attachmentHtml = $attachmentHtml . '<a href="'. config('app.app_url') .'jobsportal/public/message_attachments/'. $valAttach['attachment'] .'" target="_blank">'. $valAttach['attachment'] .'</a>';
        //             }
        //         }
    
        //         $user_details;
                
        //         $imgname_split = explode('/',$value->profile_picture_uri);
        //         if($typ == "group") {
        //             $user_details = DataArrayHelper::getUserDetail($value->from_user_id);
        //             $imgname_split = explode('/',$user_details->profile_picture_uri);
        //         }
    
        //         $user__name = $typ == "group" ? $user_details->name : $value->name;
        //         $redirect_url = route('main', ($typ == "group" ? $user_details->id : $value->from_user_id) );
                
        //         $seen_by = '';
                
        //         if($typ == "group") {
                    
        //             if(!empty($value->group_msg_read_by) && Auth::guard('company')->user()->id == $value->from_user_id ) {
        //                 $usr = DataArrayHelper::getUsers($value->group_msg_read_by, Auth::guard('company')->user()->id);
        //                 if(!empty($usr)) {
        //                     $seen_by = '<i class="fa fa-check"></i> Seen by ' .$usr;
        //                 }
        //             }
        //         } else {
                    
        //             if($value->is_read_msg == 1 && Auth::guard('company')->user()->id != $value->to_user_id) {
        //                 $usr = DataArrayHelper::getUserDetail($value->to_user_id);
        //                 $seen_by = '<i class="fa fa-check"></i> Seen by ' .$usr->name;
        //             }
        //         }
                
        //         $mkpBorder = (Auth::guard('company')->user()->id == $value->from_user_id ? "mkp__border" : "");

        //         $is_from_project_applocation = ($value->is_from_project_applocation == 1 ? 'mkp_blue' : '');

        //         $img__url = config('app.app_url') . 'jobsportal/public/images/register/' . $imgname_split[count($imgname_split) - 1];
        //         if($value->from_admin) {
        //             $img__url = $value->profile_picture_uri;
        //         }
        //         $html = $html . '
        //         <div class="message clickable '.$mkpBorder.' show-more-'.$value->id.'  " >
        //             <a href="'. $redirect_url . '" target="_blank">
        //                 <div class="photo" style="background-image: url('.$img__url.');">
        //                 <div class="online"></div>
        //                 </div>
        //             </a>
        //             <div class="text">
        //                 <a href="'. $redirect_url . '" target="_blank">
        //                 <h6>'. $user__name .'
        //                     <span class="msg_date">'. date('d-m-Y h:i:s A', strtotime($value->created_at)) .'</span>
        //                 </h6>
        //                 </a>
        //                 <p class="'.$is_from_project_applocation.'">'.$value->subject.'</p>
        //                 <div class="more-desc">
        //                     <p>'.$value->msg_body.'</p>
    
        //                     <div class="attachments">
        //                     '.$attachmentHtml.'
        //                     </div>
        //                 </div>
    
        //                 <div class="seen_by">
        //                     <p>'.$seen_by.'</p>
        //                 </div>
                        
        //             </div>
        //         </div>';
    
        //         if($typ == "group") {
        //             $updateMsg = Messages::find($value->id);
        //             if(!in_array(Auth::guard('company')->user()->id, explode(',', $updateMsg->group_msg_read_by)) && Auth::guard('company')->user()->id != $updateMsg->from_user_id) {
        //                 $updateMsg->group_msg_read_by = (!empty($updateMsg->group_msg_read_by) ? $updateMsg->group_msg_read_by  . ',' : '') . Auth::guard('company')->user()->id;    
        //                 $updateMsg->updated_at = \Carbon\Carbon::now()->toDateTimeString();    
        //                 $updateMsg->save();
        //             }
        //         } else {
        //             if(Auth::guard('company')->user()->id == $value->to_user_id) {
        //                 $updateMsg = Messages::find($value->id);
        //                 $updateMsg->is_read_msg = 1;    
        //                 $updateMsg->updated_at = \Carbon\Carbon::now()->toDateTimeString();    
        //                 $updateMsg->save();
        //             }
        //         }
                

        //     }
        // }
        // if(empty($html)) {
        //     $html = "<p class='p-4'>No message history available!</p>";
        // }

        // return view('messages.detail')
        //         ->with('html', $html)
        //         ->with('user_id', $user_id)
        //         ->with('bAdmin', $bAdmin)
        //         ->with('user_exists', $user_exists)
        //         ->with('typ', $typ);
    }

    public function sendMessage(Request $request) {
        //print_r($request->all()); die();
        
        if(!empty($request->users_id)) {
            $contacts = $request->users_id;
            // if($request->users_id[0] == "all") {
            //     $users = DB::select('call message_contacts(?)', array(Auth::guard('company')->user()->id));
            //     foreach ($users as $key => $value) {
            //         $contacts[$key] = $value->users_id;
            //     }
            // }
            // $msg_id = '';
            // $typ = 'user';
            if(count($contacts) > 1 || !empty($request->group_id) ) {
                $msg_id = $this->validateGroupMsg($request, $contacts);
                $typ = 'group';
            } else {

                foreach ($contacts as $key => $value) {
                    
                    if(is_numeric(str_replace("contact_list_", "", $value))) {

                        $sendMsg = new Messages();
                        $sendMsg->sender_id = Auth::guard('user')->user()->id;
                        $sendMsg->receiver_id = str_replace("contact_list_", "", $value);
                        $sendMsg->subject = $request->subject;
                        $sendMsg->body = $request->body;
                        $sendMsg->is_msg_from_project_application = $request->is_from_project_applocation;
                        // $sendMsg->created_at = \Carbon\Carbon::now()->toDateTimeString();
                        $sendMsg->save();
                        
                        $attached_url = '';
                        if(!empty($request->attachment)) {
                            $media = $request->file('attachment');
                            foreach ($media as $k => $media) {
                                $msgAttachment = new MessagesMedia();
                                $ext =  $media->getClientOriginalExtension();
                                $attachment_name = time().'_'.rand(111,999).'.'.$ext;
        
                                $dir = public_path() . '/uploads/message_attachments/';
                                $filename = uniqid() . '_' . time() . '.' . $ext;
                                $var = $media->move($dir, $filename);
                                
                                $attached_url .= '<a href="'.config('app.app_url') . 'jobsportal/public/message_attachments/' . $filename.'" style="display:block">Click here to see media</a>';

                                $msgAttachment->media = $filename;
                                $msgAttachment->messages_id = $sendMsg->id;
                                $msgAttachment->save();
                            }
                        }
                        $msg_id = $sendMsg->receiver_id;
                    }
                }
            }  

            // }
            // if(!empty($request->redirect_url )) {
            //     return \Redirect::route('message', ['id' => $msg_id, 'type' => \base64_encode($typ) ]);
            // }
        }
        flash("Messages Send Successfully!")->success();
        return redirect()->back();
    
    }

    private function validateGroupMsg($request, $contacts){
        if(empty($request->group_id)) {
            return $this->sendMsg($request, $contacts);
        } else {
            $grp_id = str_replace("contact_list_", "", $request->group_id);
            $checkExistingGroup = Messages::where('group_id', $grp_id)->orderBy('id', 'ASC')->first();
            if($checkExistingGroup) {
                $raw_contacts = $checkExistingGroup->from_user_id . ',' . $checkExistingGroup->to_user_id;
                $contacts = str_replace((Auth::guard('user')->user()->id . ','),'',$raw_contacts);
                return $this->sendMsg($request, $contacts, $grp_id);
            }
        }
    }

    public function deleteMessage(Request $request) {
        Messages::where('receiver_id', $request->user_id)->delete();
    }
}