<?php

namespace App\Http\Controllers\Backend;

use DataTables;
use App\Http\Controllers\Controller;
use App\Models\Backend\State;
use App\Models\Backend\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Validation\Rule; 

class StateController extends Controller
{
    public function __construct(State $state)
    {
		$this->model = $state;
    }

    public function index() {
        $countries = Country::orderBy('title', 'ASC')->pluck('title', 'id')->toArray();
        $breadcrumbs = [
            'page_title' => 'Manage State',
            'breadcrumb' => '<li> <span>Manage State</span> </li>',
            'active_page' => 'List'
        ];
        return view('backend.states.index')->with('breadcrumbs', $breadcrumbs)->with('countries', $countries);
    }  

    public function list(Request $request) {
        
        $list = $this->model::select('state.title as state', 'state.id', 'countries.title as country')
        ->join('countries', 'countries.id', '=', 'state.country_id');
        // orderBy('state.title')->
        return Datatables::of($list)
                ->orderColumn('state',  'state $1')
                ->orderColumn('country',  'country $1')

                ->filter(function ($query) use ($request) {
                    if ($request->has('state') && !empty($request->state)) {
                        $query->where('state.title', 'like', "%{$request->get('state')}%");
                    }
                    if ($request->has('country_id') && !empty($request->country_id)) {
                        $query->where('state.country_id', $request->get('country_id'));
                    }
                })
                ->addColumn('country', function ($list) {
                    return $list->country;
                })
                ->addColumn('state', function ($list) {
                    return $list->state;
                })
                ->addColumn('action', function ($list) {
                    return '
                        <div class="btn-group">
                            <button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="' . route('admin.edit.state', ['id' => $list->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
                                </li>						
                                <li>
                                    <a href="javascript:void(0);" onclick="deleteRecord(' . $list->id .');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
                                </li>
                            </ul>
                        </div>';
                })
                ->rawColumns(['country', 'state', 'action'])
                ->setRowId(function($list) {
                    return 'stateDtRow' . $list->id;
                })->make(true);
    }

    public function add() {

        $countries = Country::orderBy('title', 'ASC')->pluck('title', 'id')->toArray();
        $breadcrumbs = [
            'page_title' => 'Manage State',
            'breadcrumb' => '<li> <a href="'.route('admin.state').'">Manage State</a> <i class="fa fa-circle"></i> </li><li> <span>Add</span> </li>',
            'active_page' => 'Add'
        ];
        return view('backend.states.add')->with('breadcrumbs', $breadcrumbs)->with('countries', $countries);
    }
    
    public function edit($id) {

        $detail = $this->model::findOrFail($id);
        $countries = Country::orderBy('title', 'ASC')->pluck('title', 'id')->toArray();

        $breadcrumbs = [
            'page_title' => 'Manage State',
            'breadcrumb' => '<li> <a href="'.route('admin.state').'">Manage State</a> <i class="fa fa-circle"></i> </li><li> <span>Edit</span> </li>',
            'active_page' => 'Edit'
        ];
        return view('backend.states.edit')->with('detail', $detail)->with('breadcrumbs', $breadcrumbs)->with('countries', $countries);
    }
    
    public function save(Request $request) {
        
        // $validator = Validator::make($request->all(), [
        //     'country_id' => 'required',
        //     'title' => 'required|unique:state,country_id|max:255',
        // ]);
        $title = $request->title;
        $country_id = $request->country_id;
        
        $validator = Validator::make($request->all(), [
            'country_id' => ['required'],
            'title' => [
                'required',
                // Rule::unique('state')->ignore($id),
                Rule::unique('state')->where(function ($query) use($title, $country_id) {
                    return $query->where('title', $title)
                    ->where('country_id', $country_id);
                })
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = new $this->model();
        $data->country_id = $request->country_id;        
        $data->title = $request->title;
        $data->title_fr = $request->title_fr;
        $data->save();
        
        flash('Record has been added!')->success();
        
        return \redirect(route('admin.state'));
    }
    
    public function update(Request $request) {
        $id = $request->id;
        $title = $request->title;
        $country_id = $request->country_id;

        $validator = Validator::make($request->all(), [
            'country_id' => ['required'],
            'title' => [
                'required',
                // Rule::unique('state')->ignore($id),
                Rule::unique('state')->where(function ($query) use($id,$title, $country_id) {
                    return $query->where('title', $title)
                    ->where('country_id', $country_id)
                    ->where('id', '!=',  $id);
                })
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $this->model::findOrFail($request->id);
        
        $data->country_id = $request->country_id;
        $data->title = $request->title;
        $data->title_fr = $request->title_fr;
        $data->save();
        flash('Record has been updated!')->success();
        
        return \redirect(route('admin.state'));
    }
    
    public function delete(Request $request) {
        $this->model::findOrFail($request->id)->delete();
        // flash('Record has been deleted!')->success();
        echo "ok";
        // return \redirect(route('admin.state'));
    }

    
}

