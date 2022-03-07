<?php

namespace App\Http\Controllers\Backend;

use DataTables;
use App\Http\Controllers\Controller;
use App\Models\Backend\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Validation\Rule; 

class CountryController extends Controller
{
    public function __construct(Country $country)
    {
		$this->model = $country;
    }

    public function index() {

        $breadcrumbs = [
            'page_title' => 'Manage Country',
            'breadcrumb' => '<li> <span>Manage Country</span> </li>',
            'active_page' => 'List'
        ];
        return view('backend.countries.index')->with('breadcrumbs', $breadcrumbs);
    }  

    public function list(Request $request) {
        
        $list = $this->model::select('title as country', 'id'); //orderBy('title');
        return Datatables::of($list)
                ->orderColumn('country',  'country $1')
                
                ->filter(function ($query) use ($request) {
                    if ($request->has('country') && !empty($request->country)) {
                        $query->where('countries.country', 'like', "%{$request->get('country')}%");
                    }
                })
                ->addColumn('country', function ($list) {
                    return $list->country;
                })
                ->addColumn('action', function ($list) {
                    return '
                        <div class="btn-group">
                            <button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="' . route('admin.edit.country', ['id' => $list->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
                                </li>						
                                <li>
                                    <a href="javascript:void(0);" onclick="deleteCountry(' . $list->id .');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
                                </li>
                            </ul>
                        </div>';
                })
                ->rawColumns(['country', 'action'])
                ->setRowId(function($list) {
                    return 'countryDtRow' . $list->id;
                })->make(true);
    }

    public function add() {

        $breadcrumbs = [
            'page_title' => 'Manage Country',
            'breadcrumb' => '<li> <a href="'.route('admin.country').'">Manage Country</a> <i class="fa fa-circle"></i> </li><li> <span>Add</span> </li>',
            'active_page' => 'Add'
        ];
        return view('backend.countries.add')->with('breadcrumbs', $breadcrumbs);
    }
    
    public function edit($id) {

        $detail = $this->model::findOrFail($id);

        $breadcrumbs = [
            'page_title' => 'Manage Country',
            'breadcrumb' => '<li> <a href="'.route('admin.country').'">Manage Country</a> <i class="fa fa-circle"></i> </li><li> <span>Edit</span> </li>',
            'active_page' => 'Edit'
        ];
        return view('backend.countries.edit')->with('detail', $detail)->with('breadcrumbs', $breadcrumbs);
    }
    
    public function save(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:countries|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = new $this->model();        
        $data->title = $request->title;
        $data->title_fr = $request->title_fr;
        $data->save();
        
        flash('Record has been added!')->success();
        
        return \redirect(route('admin.country'));
    }
    
    public function update(Request $request) {
        $id = $request->id;
        $validator = Validator::make($request->all(), [
            'title' => [
                'required',
                Rule::unique('countries')->ignore($id),
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $this->model::findOrFail($request->id);
        
        $data->title = $request->title;
        $data->title_fr = $request->title_fr;
        $data->save();
        flash('Record has been updated!')->success();
        
        return \redirect(route('admin.country'));
    }
    
    public function delete(Request $request) {
        $this->model::findOrFail($request->id)->delete();
        // flash('Record has been deleted!')->success();
        echo "ok";
        // return \redirect(route('admin.country'));
    }

    
}

