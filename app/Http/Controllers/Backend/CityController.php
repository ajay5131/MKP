<?php

namespace App\Http\Controllers\Backend;

use DataTables;
use App\Http\Controllers\Controller;
use App\Models\Backend\State;
use App\Models\Backend\Country;
use App\Models\Backend\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Validation\Rule; 

class CityController extends Controller
{
    public function __construct(City $city)
    {
		$this->model = $city;
    }

    public function index() {
        $countries = Country::orderBy('title', 'ASC')->pluck('title', 'id')->toArray();
        $breadcrumbs = [
            'page_title' => 'Manage City',
            'breadcrumb' => '<li> <span>Manage City</span> </li>',
            'active_page' => 'List'
        ];
        return view('backend.cities.index')->with('breadcrumbs', $breadcrumbs)->with('countries', $countries);
    }  

    public function list(Request $request) {
        
        $list = $this->model::select('city.title as city', 'city.id', 'countries.title as country', 'state.title as state')
        ->join('state', 'state.id', '=', 'city.state_id')
        ->join('countries', 'countries.id', '=', 'state.country_id');//orderBy('city.title')->
        
        return Datatables::of($list)
                
                ->orderColumn('country',  'country $1')
                ->orderColumn('state',  'state $1')
                ->orderColumn('city',  'city $1')

                ->filter(function ($query) use ($request) {
                    if ($request->has('city') && !empty($request->city)) {
                        $query->where('city', 'like', "%{$request->get('city')}%");
                    }
                    if ($request->has('country_id') && !empty($request->country_id)) {
                        $query->where('countries.id', $request->get('country_id'));
                    }
                    if ($request->has('state_id') && !empty($request->state_id)) {
                        $query->where('city.state_id', $request->get('state_id'));
                    }
                })
                ->addColumn('country', function ($list) {
                    return $list->country;
                })
                ->addColumn('state', function ($list) {
                    return $list->state;
                })
                ->addColumn('city', function ($list) {
                    return $list->city;
                })
                ->addColumn('action', function ($list) {
                    return '
                        <div class="btn-group">
                            <button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="' . route('admin.edit.city', ['id' => $list->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
                                </li>						
                                <li>
                                    <a href="javascript:void(0);" onclick="deleteRecord(' . $list->id .');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
                                </li>
                            </ul>
                        </div>';
                })
                ->rawColumns(['country', 'state', 'city', 'action'])
                ->setRowId(function($list) {
                    return 'cityDtRow' . $list->id;
                })->make(true);
    }

    public function add() {

        $countries = Country::orderBy('title', 'ASC')->pluck('title', 'id')->toArray();
        $breadcrumbs = [
            'page_title' => 'Manage City',
            'breadcrumb' => '<li> <a href="'.route('admin.city').'">Manage City</a> <i class="fa fa-circle"></i> </li><li> <span>Add</span> </li>',
            'active_page' => 'Add'
        ];
        return view('backend.cities.add')->with('breadcrumbs', $breadcrumbs)->with('countries', $countries);
    }
    
    public function edit($id) {

        $detail = $this->model::findOrFail($id);
        $countries = Country::orderBy('title', 'ASC')->pluck('title', 'id')->toArray();
        $breadcrumbs = [
            'page_title' => 'Manage City',
            'breadcrumb' => '<li> <a href="'.route('admin.city').'">Manage City</a> <i class="fa fa-circle"></i> </li><li> <span>Edit</span> </li>',
            'active_page' => 'Edit'
        ];
        return view('backend.cities.edit')->with('detail', $detail)->with('breadcrumbs', $breadcrumbs)->with('countries', $countries);
    }
    
    public function save(Request $request) {
        
        // $validator = Validator::make($request->all(), [
        //     'country_id' => 'required',
        //     'title' => 'required|unique:state,country_id|max:255',
        // ]);
        $title = $request->title;
        $state_id = $request->state_id;
        
        $validator = Validator::make($request->all(), [
            'state_id' => ['required'],
            'title' => [
                'required',
                // Rule::unique('state')->ignore($id),
                Rule::unique('city')->where(function ($query) use($title, $state_id) {
                    return $query->where('title', $title)
                    ->where('state_id', $state_id);
                })
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = new $this->model();
        $data->state_id = $request->state_id;        
        $data->title = $request->title;
        $data->title_fr = $request->title_fr;
        $data->save();
        
        flash('Record has been added!')->success();
        
        return \redirect(route('admin.city'));
    }
    
    public function update(Request $request) {
        $id = $request->id;
        $title = $request->title;
        $state_id = $request->state_id;

        $validator = Validator::make($request->all(), [
            'state_id' => ['required'],
            'title' => [
                'required',
                // Rule::unique('state')->ignore($id),
                Rule::unique('city')->where(function ($query) use($id,$title, $state_id) {
                    return $query->where('title', $title)
                    ->where('state_id', $state_id)
                    ->where('id', '!=',  $id);
                })
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $this->model::findOrFail($request->id);
        
        $data->state_id = $request->state_id;
        $data->title = $request->title;
        $data->title_fr = $request->title_fr;
        $data->save();
        flash('Record has been updated!')->success();
        
        return \redirect(route('admin.city'));
    }
    
    public function delete(Request $request) {
        $this->model::findOrFail($request->id)->delete();
        // flash('Record has been deleted!')->success();
        echo "ok";
        // return \redirect(route('admin.city'));
    }

    
}

