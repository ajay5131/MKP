<?php

namespace App\Http\Controllers\Backend;

use DataTables;
use App\Http\Controllers\Controller;
use App\Models\Backend\Admin;
use App\Models\Frontend\UsersProfile;
use App\Models\Frontend\Profiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule; 

class UserProfilesController extends Controller
{
    public function __construct(Admin $admin)
    {
		$this->model = $admin;
    }

    public function index() {
        
        $breadcrumbs = [
            'page_title' => 'Manage User Profiles',
            'breadcrumb' => '<li> <span>Manage User Profiles</span> </li>',
            'active_page' => 'List'
        ];
        return view('backend.users.index')->with('breadcrumbs', $breadcrumbs);
    }  

    public function list(Request $request) {
        
        $list = $this->model::where('user_role_id', 2)
                            ->select('users.id', 'users_profiles.handle_name', 'users_profiles.full_name', 'users.email', 'users.who_are_you', 'users.how_did_hear_about_us', 'users_profiles.users_id', 'users.status', 'users_profiles.profile_pic')
                            ->join('users_profiles', 'users_profiles.users_id', '=', 'users.id')
                            ->where('users_profiles.profile_id', 1);
                            //->orderByDesc('users.id')

        return Datatables::of($list)
                ->orderColumn('full_name',  'full_name $1')
                ->orderColumn('email',  'email $1')
                ->orderColumn('who_are_you',  'who_are_you $1')
                ->orderColumn('status',  'status $1')

                ->filter(function ($query) use ($request) {
                    if ($request->has('full_name') && !empty($request->full_name)) {
                        $query->where('full_name', 'like', "%{$request->get('full_name')}%");
                    }
                    if ($request->has('email') && !empty($request->email)) {
                        $query->where('email', 'like', "%{$request->get('email')}%");
                    }
                })
                ->addColumn('profile_pic', function ($list) {
                    return '<a href="'.route('main', $list->handle_name).'" target="_blank"><img src="'. asset('/') . 'uploads/profile_picture/'.$list->profile_pic .'" style="width: 40px;height: auto;" alt=""></a>';
                })
                ->addColumn('full_name', function ($list) {
                    return $list->full_name;
                })
                ->addColumn('email', function ($list) {
                    return $list->email;
                })
                ->addColumn('who_are_you', function ($list) {
                    return $list->who_are_you;
                })
                ->addColumn('how_did_hear_about_us', function ($list) {
                    if($list->how_did_hear_about_us == "0") {
                        return "Someone told me about it";
                    }
                    return $list->how_did_hear_about_us;
                })
                ->addColumn('profiles', function ($list) {
                    return $list->getActiveProfileCount($list->users_id);
                })
                ->addColumn('status', function ($list) {
                    if($list->status == 0) {
                        return "Inactive";
                    }
                    return "Active";
                })
                ->addColumn('action', function ($list) {
                    return '
                        <div class="btn-group">
                            <button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu custom_dropdown">
                                <li>
                                    <a href="javascript:void(0);" onclick="changeStatus(' . $list->id .', '.$list->status.');" class=""><i class="fa fa-'.($list->status == 1 ? 'check-square-o' : 'square-o').'" aria-hidden="true"></i> '.($list->status == 1 ? 'Make Inactive' : 'Make Active').'</a>
                                </li>
                                <li>
                                    <a href="'.route('view.user.profiles', $list->id).'"><i class="fa fa-eye" aria-hidden="true"></i> View Profiles</a>
                                </li>
                            </ul>
                        </div>';
                })
                
                ->rawColumns(['profile_pic', 'full_name', 'email', 'who_are_you', 'how_did_hear_about_us', 'profiles', 'status', 'action'])
                ->setRowId(function($list) {
                    return 'adminDtRow' . $list->id;
                })->make(true);
    }

    public function changeStatus(Request $request) {
        $this->model::where('id', $request->user_id)->update(['status' => ($request->status == 1 ? 0 : 1) ]);
    }
    
    public function viewProfiles(Request $request){
        // view_profiles
        $user_profiles = UsersProfile::where('users_id', $request->id)->where('status', 1)->orderBy('profile_id')->get();
        $profiles = Profiles::pluck('title', 'id')->toArray();
        return view('backend.users.view_profiles')->with('user_profiles', $user_profiles)->with('profiles', $profiles);
    }

    public function updateProfilesBadge(Request $request) {
        UsersProfile::where('id', $request->id)->update(['profile_badge' => $request->profile_badge ]);
    }
}

