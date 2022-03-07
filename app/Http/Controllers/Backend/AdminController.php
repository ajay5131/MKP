<?php

namespace App\Http\Controllers\Backend;

use DataTables;
use App\Http\Controllers\Controller;
use App\Models\Backend\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule; 
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct(Admin $admin)
    {
		$this->model = $admin;
    }

    public function index() {
        
        $breadcrumbs = [
            'page_title' => 'Manage Admin User',
            'breadcrumb' => '<li> <span>Manage Admin User</span> </li>',
            'active_page' => 'List'
        ];
        return view('backend.admin.index')->with('breadcrumbs', $breadcrumbs);
    }  

    public function list(Request $request) {
        
        $list = $this->model::where('user_role_id', 1);//->orderBy('full_name');
        return Datatables::of($list)
                ->orderColumn('full_name',  'full_name $1')
                ->orderColumn('email',  'email $1')
                ->filter(function ($query) use ($request) {
                    if ($request->has('full_name') && !empty($request->full_name)) {
                        $query->where('full_name', 'like', "%{$request->get('full_name')}%");
                    }
                    if ($request->has('email') && !empty($request->email)) {
                        $query->where('email', 'like', "%{$request->get('email')}%");
                    }
                })
                ->addColumn('full_name', function ($list) {
                    return $list->full_name;
                })
                ->addColumn('email', function ($list) {
                    return $list->email;
                })
                ->addColumn('action', function ($list) {

                    if(Auth::guard('admin')->user()->email != $list->email) {
                        return '
                            <div class="btn-group">
                                <button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="' . route('admin.edit.user', ['id' => $list->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
                                    </li>						
                                    <li>
                                        <a href="javascript:void(0);" onclick="deleteRecord(' . $list->id .');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
                                    </li>
                                </ul>
                            </div>';
                    } else {
                        return '
                            <div class="btn-group">
                                <button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="' . route('admin.edit.user', ['id' => $list->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
                                    </li>						
                                    
                                </ul>
                            </div>';

                    }
                })
                ->rawColumns(['full_name', 'email', 'action'])
                ->setRowId(function($list) {
                    return 'adminDtRow' . $list->id;
                })->make(true);
    }

    public function add() {

        $breadcrumbs = [
            'page_title' => 'Manage Admin User',
            'breadcrumb' => '<li> <a href="'.route('admin.user').'">Manage Admin User</a> <i class="fa fa-circle"></i> </li><li> <span>Add</span> </li>',
            'active_page' => 'Add'
        ];
        return view('backend.admin.add')->with('breadcrumbs', $breadcrumbs);
    }
    
    public function edit($id) {

        $detail = $this->model::findOrFail($id);
        
        $breadcrumbs = [
            'page_title' => 'Manage Admin User',
            'breadcrumb' => '<li> <a href="'.route('admin.user').'">Manage Admin User</a> <i class="fa fa-circle"></i> </li><li> <span>Edit</span> </li>',
            'active_page' => 'Edit'
        ];
        return view('backend.admin.edit')->with('detail', $detail)->with('breadcrumbs', $breadcrumbs);
    }
    
    public function save(Request $request) {
        $email = $request->email;
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|unique:users|max:255',
            'email' => [
                'required', 'email',
                Rule::unique('users')->where(function ($query) use($email) {
                    return $query->where('email', $email)
                    ->where('user_role_id', '=',  1);
                })
            ],
            'password' => 'required'
        ]);        

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = new $this->model();
        $data->user_role_id = 1;
        $data->full_name = $request->full_name;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->email_verification = 1;
        $data->status = 1;

        $data->save();
        
        flash('Record has been added!')->success();
        
        return \redirect(route('admin.user'));
    }
    
    public function update(Request $request) {
        $id = $request->id;
        $full_name = $request->full_name;
        $email = $request->email;
        $validator = Validator::make($request->all(), [
            'full_name' => [
                'required',
                Rule::unique('users')->where(function ($query) use($id,$full_name) {
                    return $query->where('full_name', $full_name)
                    ->where('id', '!=',  $id);
                })
            ],
            'email' => [
                'required', 'email',
                Rule::unique('users')->where(function ($query) use($id,$email) {
                    return $query->where('email', $email)
                    ->where('user_role_id',  1)
                    ->where('id', '!=',  $id);
                })
            ]
        ]);        
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $this->model::findOrFail($request->id);

        $data->user_role_id = 1;
        $data->full_name = $request->full_name;
        $data->email = $request->email;
        if(!empty($request->password)) {
            $data->password = Hash::make($request->password);
        }
        $data->email_verification = 1;
        $data->status = 1;
        $data->save();
        
        flash('Record has been updated!')->success();
        
        return \redirect(route('admin.user'));
    }
    
    public function delete(Request $request) {
        $this->model::findOrFail($request->id)->delete();
        echo "ok";
    }

    
}

