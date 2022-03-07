<?php

namespace App\Http\Controllers\Backend;

use DataTables;
use App\Http\Controllers\Controller;
use App\Models\Backend\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Validation\Rule; 

class LanguageController extends Controller
{
    public function __construct(Language $language)
    {
		$this->model = $language;
    }

    public function index() {
        $breadcrumbs = [
            'page_title' => 'Manage Language',
            'breadcrumb' => '<li> <span>Manage Language</span> </li>',
            'active_page' => 'List'
        ];
        return view('backend.language.index')->with('breadcrumbs', $breadcrumbs);
    }  

    public function list(Request $request) {
        
        $list = $this->model::select('*'); //orderBy('language');
        
        return Datatables::of($list)
                ->orderColumn('code',  'code $1')
                ->orderColumn('language',  'language $1')

                ->filter(function ($query) use ($request) {
                    if ($request->has('language') && !empty($request->language)) {
                        $query->where('language', 'like', "%{$request->get('language')}%");
                    }
                })
                ->addColumn('code', function ($list) {
                    return $list->code;
                })
                ->addColumn('language', function ($list) {
                    return $list->language;
                })
                
                ->addColumn('action', function ($list) {
                    $icon = 'square-o';
                    $action_text = 'Active';                    
                    if($list->status == 1) {
                        $icon = 'check-square-o';
                        $action_text = 'InActive';
                    }
                    return '
                        <div class="btn-group">
                            <button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="' . route('admin.edit.language', ['id' => $list->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" onclick="changeStatus(' . $list->id .', '.$list->status.');" class=""><i class="fa fa-'.$icon.'" aria-hidden="true"></i>Make '.$action_text.'</a>
                                </li>
                            </ul>
                        </div>';
                })
                // <li>
                //                     <a href="javascript:void(0);" onclick="deleteRecord(' . $list->id .');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
                //                 </li>
                ->rawColumns(['language', 'action'])
                ->setRowId(function($list) {
                    return 'tableDtRow' . $list->id;
                })->make(true);
    }

    public function add() {
        $breadcrumbs = [
            'page_title' => 'Manage Language',
            'breadcrumb' => '<li> <a href="'.route('admin.language').'">Manage Language</a> <i class="fa fa-circle"></i> </li><li> <span>Add</span> </li>',
            'active_page' => 'Add'
        ];
        return view('backend.language.add')->with('breadcrumbs', $breadcrumbs);
    }
    
    public function edit($id) {

        $detail = $this->model::findOrFail($id);
        $breadcrumbs = [
            'page_title' => 'Manage Language',
            'breadcrumb' => '<li> <a href="'.route('admin.language').'">Manage Language</a> <i class="fa fa-circle"></i> </li><li> <span>Edit</span> </li>',
            'active_page' => 'Edit'
        ];
        return view('backend.language.edit')->with('detail', $detail)->with('breadcrumbs', $breadcrumbs);
    }
    
    public function save(Request $request) {
        
        $title = $request->title;
        
        $validator = Validator::make($request->all(), [
            'language' => 'required|unique:languages|max:255',
            'code' => 'required|unique:languages|max:10',
            'status' => 'required',
            'direction' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = new $this->model();
        $data->language = $request->language;        
        $data->code = $request->code;
        $data->direction = $request->direction;
        $data->status = $request->status;
        $data->save();
        
        flash('Record has been added!')->success();
        
        return \redirect(route('admin.language'));
    }
    
    public function update(Request $request) {
        $id = $request->id;
        $language = $request->language;
        $code = $request->code;

        $validator = Validator::make($request->all(), [
            'language' => [
                'required',
                'max:255',
                Rule::unique('languages')->where(function ($query) use($id,$language) {
                    return $query->where('language', $language)
                    ->where('id', '!=',  $id);
                })
            ],
            'code' => [
                'required',
                'max:10',
                Rule::unique('languages')->where(function ($query) use($id,$code) {
                    return $query->where('code', $code)
                    ->where('id', '!=',  $id);
                })
            ],
            'status' => ['required'],
            'direction' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $this->model::findOrFail($request->id);
        
        $data->language = $request->language;        
        $data->code = $request->code;
        $data->direction = $request->direction;
        $data->status = $request->status;
        $data->save();
        flash('Record has been updated!')->success();
        
        return \redirect(route('admin.language'));
    }
    
    public function changeStatus(Request $request) {
        $data = $this->model::findOrFail($request->id);
        if($request->status == 1) {
            $data->status = 0;
        } else {
            $data->status = 1;
        }
        $data->save();
    
        echo "ok";
    
    }

    
}

