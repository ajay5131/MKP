<?php

namespace App\Http\Controllers\Backend;

use DataTables;
use App\Http\Controllers\Controller;
use App\Models\Backend\Team;
use App\Models\Backend\Language;
use App\Models\Backend\TeamDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Validation\Rule; 
use App\Rules\ValidateArrayElement;

class TeamController extends Controller
{
    public function __construct(Team $team)
    {
		$this->model = $team;
    }

    public function index() {
        $team_type = ['1' => 'MKP Team', '2' => 'Partners', '3' => 'Mentor'];
        $breadcrumbs = [
            'page_title' => 'Manage Meet Our Team',
            'breadcrumb' => '<li> <span>Manage Meet Our Team</span> </li>',
            'active_page' => 'List'
        ];
        return view('backend.team.index')->with('breadcrumbs', $breadcrumbs)->with('team_type', $team_type);
    }  

    public function list(Request $request) {
        
        $list = $this->model::select('*'); //orderBy('full_name');
        return Datatables::of($list)
                ->orderColumn('full_name',  'full_name $1')
                ->orderColumn('designation',  'designation $1')
                
                ->orderColumn('sort_order',  'sort_order $1')

                ->filter(function ($query) use ($request) {
                    if ($request->has('full_name') && !empty($request->full_name)) {
                        $query->where('full_name', 'like', "%{$request->get('full_name')}%");
                    }
                    if ($request->has('designation') && !empty($request->designation)) {
                        $query->where('designation', 'like', "%{$request->get('designation')}%");
                    }
                    if ($request->has('team_type') && !empty($request->team_type)) {
                        $query->where('team_type', $request->get('team_type'));
                    }
                })
                ->addColumn('media', function ($list) {
                    return '<img src="'. asset('uploads/our_team/'.$list->media) .'" height="60" alt="">';
                })
                ->addColumn('team_type', function ($list) {
                    return ($list->team_type == 1 ? 'MKP Team' : ($list->team_type == 2 ? 'Partners' : 'Mentor'));
                })
                ->addColumn('full_name', function ($list) {
                    return $list->full_name;
                })
                ->addColumn('designation', function ($list) {
                    return $list->designation;
                })
                ->addColumn('sort_order', function ($list) {
                    return $list->sort_order;
                })
                ->addColumn('action', function ($list) {
                    return '
                        <div class="btn-group">
                            <button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="' . route('admin.edit.team', ['id' => $list->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
                                </li>						
                                <li>
                                    <a href="javascript:void(0);" onclick="deleteRecord(' . $list->id .');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
                                </li>
                            </ul>
                        </div>';
                })
                ->rawColumns(['media', 'full_name', 'action'])
                ->setRowId(function($list) {
                    return 'teamDtRow' . $list->id;
                })->make(true);
    }

    public function add() {
        $team_type = ['1' => 'MKP Team', '2' => 'Partners', '3' => 'Mentor'];
        $languages = Language::orderBy('language')->pluck('language as title', 'id')->toArray();

        $breadcrumbs = [
            'page_title' => 'Manage Meet Our Team',
            'breadcrumb' => '<li> <a href="'.route('admin.team').'">Manage Meet Our Team</a> <i class="fa fa-circle"></i> </li><li> <span>Add</span> </li>',
            'active_page' => 'Add'
        ];
        return view('backend.team.add')->with('breadcrumbs', $breadcrumbs)->with('team_type', $team_type)->with('languages', $languages);
    }
    
    public function edit($id) {

        $detail = $this->model::findOrFail($id);
        $team_type = ['1' => 'MKP Team', '2' => 'Partners', '3' => 'Mentor'];
        
        $languages = Language::orderBy('language')->pluck('language as title', 'id')->toArray();
        $team_detail = TeamDetail::where('our_team_id', $id)->get();
        $breadcrumbs = [
            'page_title' => 'Manage Meet Our Team',
            'breadcrumb' => '<li> <a href="'.route('admin.team').'">Manage Meet Our Team</a> <i class="fa fa-circle"></i> </li><li> <span>Edit</span> </li>',
            'active_page' => 'Edit'
        ];
        return view('backend.team.edit')->with('detail', $detail)->with('breadcrumbs', $breadcrumbs)->with('team_type', $team_type)->with('languages', $languages)->with('team_detail', $team_detail);
    }
    
    public function save(Request $request) {
        $validator = Validator::make($request->all(), [
            'language_id' => [new ValidateArrayElement(), 'required'],
            'full_name' => [new ValidateArrayElement(), 'required', 'unique:our_team', 'max:255'],
            'media' => 'required|mimes:jpeg,jpg,png',
            'team_type' => 'required',
            'designation' => [new ValidateArrayElement(), 'required', 'max:255'],
            'description' => [new ValidateArrayElement(), 'required']
        ]);        

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = new $this->model();
        $data->language_id = $request->language_id[0];
        $data->full_name = $request->full_name[0];
        // $data->full_name_fr = $request->full_name_fr;
        $data->designation = $request->designation[0];
        // $data->designation_fr = $request->designation_fr;
        $data->description = $request->description[0];
        // $data->description_fr = $request->description_fr;
        $data->team_type = $request->team_type;
        $data->tag_id = $request->tag_id;

        $data->slug = \Str::slug($request->full_name[0], '-');

        $sort_order = 1;
        $max_order = $this->model::where('team_type', $request->team_type)->max('sort_order');
        if(!empty($max_order)) {
            $sort_order = ($max_order + 1);
        }
        $data->sort_order = $sort_order;

        // Upload media
        $upload_video_link =  $request->file('media');
        $extension = $request->file('media')->getClientOriginalExtension();
        $dir = public_path() .'/uploads/our_team/';
        $filename = uniqid() . '_' . time() . '.' . $extension;
        $var = $request->file('media')->move($dir, $filename);
        
        $data->media = $filename;

        $data->save();

        for ($i=1; $i < count($request->language_id) ; $i++) { 
            if(!empty($request->language_id[$i]) && !empty($request->full_name[$i]) && !empty($request->description[$i]) && !empty($request->designation[$i]) ) {
                $detail = new TeamDetail();
                $detail->our_team_id = $data->id;
                $detail->language_id = $request->language_id[$i];
                $detail->full_name = $request->full_name[$i];
                $detail->designation = $request->designation[$i];
                $detail->description = $request->description[$i];
                $detail->save();
            }
        }
        
        flash('Record has been added!')->success();
        
        return \redirect(route('admin.team'));
    }
    
    public function update(Request $request) {
        $id = $request->id;
        $title = $request->full_name[0];

        $validator = Validator::make($request->all(), [
            'full_name' => [
                new ValidateArrayElement(),
                'required',
                Rule::unique('our_team')->where(function ($query) use($id,$title) {
                    return $query->where('full_name', $title)
                    ->where('id', '!=',  $id);
                })
            ],
            'team_type' => ['required'],
            'designation' => [new ValidateArrayElement(), 'required'],
            'description' => [new ValidateArrayElement(), 'required']
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $this->model::findOrFail($request->id);
        
        $data->language_id = $request->language_id[0];
        $data->full_name = $request->full_name[0];
        // $data->full_name_fr = $request->full_name_fr;
        $data->designation = $request->designation[0];
        // $data->designation_fr = $request->designation_fr;
        $data->description = $request->description[0];
        // $data->description_fr = $request->description_fr;
        $data->team_type = $request->team_type;
        $data->tag_id = $request->tag_id;

        $data->slug = \Str::slug($request->full_name[0], '-');
        
        $team = $this->model::findOrFail($id);
        $sort_order = 1;
        if($team->team_type != $request->team_type) {
            $max_order = $this->model::where('team_type', $request->team_type)->max('sort_order');
            if(!empty($max_order)) {
                $sort_order = ($max_order + 1);
            }
            $data->sort_order = $sort_order;
        }
        
        if(!empty($request->media)) {

            // Upload media
            $upload_video_link =  $request->file('media');
            $extension = $request->file('media')->getClientOriginalExtension();
            $dir = public_path() .'/uploads/our_team/';
            $filename = uniqid() . '_' . time() . '.' . $extension;
            $var = $request->file('media')->move($dir, $filename);
            
            $data->media = $filename;

        }

        $data->save();

        TeamDetail::where('our_team_id', $request->id)->delete();

        for ($i=1; $i < count($request->language_id) ; $i++) { 
            if(!empty($request->language_id[$i]) && !empty($request->full_name[$i]) && !empty($request->description[$i]) && !empty($request->designation[$i]) ) {
                $detail = new TeamDetail();
                $detail->our_team_id = $data->id;
                $detail->language_id = $request->language_id[$i];
                $detail->full_name = $request->full_name[$i];
                $detail->designation = $request->designation[$i];
                $detail->description = $request->description[$i];
                $detail->save();
            }
        }
        
        flash('Record has been updated!')->success();
        
        return \redirect(route('admin.team'));
    }
    
    public function delete(Request $request) {
        $this->model::findOrFail($request->id)->delete();
        TeamDetail::where('our_team_id', $request->id)->delete();
        echo "ok";
    }

    public function sort() {
        $breadcrumbs = [
            'page_title' => 'Manage Meet Our Team',
            'breadcrumb' => '<li> <a href="'.route('admin.team').'">Manage Meet Our Team</a> <i class="fa fa-circle"></i> </li><li> <span>Sort</span> </li>',
            'active_page' => 'Sort'
        ];
        return view('backend.team.sort')->with('breadcrumbs', $breadcrumbs);
    }

    public function getTeamSortData(Request $request) {
        $teams = $this->model::where('team_type', $request->teamtype)->orderBy('sort_order')->get();

        $html = '';
        if (count($teams) > 0) {
            $html = '<ul id="sortable" class="sortable">';
            foreach ($teams as $team) {
                $html .= "<li id='$team->id'><i class='fa fa-sort'></i><strong>".ucwords($team->full_name)."</strong> <small>$team->designation</small></li>";
            }
            $html .= '</ul>';
        } else {
            $html = '<p class="pl-1">No data found!</p>';
        }

        echo $html;
    }
    public function sortUpdate(Request $request) {
        $team_order_array = explode(',', $request->team_order);
        foreach ($team_order_array as $k => $team_id) {
            $this->model::where('id',$team_id)->update(['sort_order'=>$k+1]);
        }
    }

    
}

