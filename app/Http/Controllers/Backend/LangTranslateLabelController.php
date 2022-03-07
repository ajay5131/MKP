<?php

namespace App\Http\Controllers\Backend;

use DataTables;
use App\Http\Controllers\Controller;
use App\Models\Backend\LangTranslateLabel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Validation\Rule; 

class LangTranslateLabelController extends Controller
{
    public function __construct(LangTranslateLabel $langtranslatelabel)
    {
		$this->model = $langtranslatelabel;
    }

    public function index() {
        
        $breadcrumbs = [
            'page_title' => 'Manage Translate Label',
            'breadcrumb' => '<li> <span>Manage Translate Label</span> </li>',
            'active_page' => 'List'
        ];
        return view('backend.langtranslatelabel.index')->with('breadcrumbs', $breadcrumbs);
    }  

    public function list(Request $request) {
        
        $list = $this->model::orderBy('title');
        return Datatables::of($list)
                ->filter(function ($query) use ($request) {
                    if ($request->has('title') && !empty($request->title)) {
                        $query->where('title', 'like', "%{$request->get('title')}%");
                    }
                })
                ->addColumn('title', function ($list) {
                    return $list->title;
                })
                ->addColumn('action', function ($list) {
                    return '
                        <div class="btn-group">
                            <button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="' . route('admin.edit.language.translate.label', ['id' => $list->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
                                </li>						
                            </ul>
                        </div>';
                })
                ->rawColumns(['title', 'action'])
                ->setRowId(function($list) {
                    return 'tableDtRow' . $list->id;
                })->make(true);
    }

    public function add() {

        $breadcrumbs = [
            'page_title' => 'Manage Translate Label',
            'breadcrumb' => '<li> <a href="'.route('admin.language.translate.label').'">Manage Translate Label</a> <i class="fa fa-circle"></i> </li><li> <span>Add</span> </li>',
            'active_page' => 'Add'
        ];
        return view('backend.langtranslatelabel.add')->with('breadcrumbs', $breadcrumbs);
    }
    
    public function edit($id) {

        $detail = $this->model::findOrFail($id);

        $breadcrumbs = [
            'page_title' => 'Manage Translate Label',
            'breadcrumb' => '<li> <a href="'.route('admin.language.translate.label').'">Manage Translate Label</a> <i class="fa fa-circle"></i> </li><li> <span>Edit</span> </li>',
            'active_page' => 'Edit'
        ];
        return view('backend.langtranslatelabel.edit')->with('detail', $detail)->with('breadcrumbs', $breadcrumbs);
    }
    
    public function save(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:lang_translate_label|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = new $this->model();        
        $data->title = $request->title;
        $data->save();
        
        flash('Record has been added!')->success();
        
        return \redirect(route('admin.add.language.translate.label'));
    }
    
    public function update(Request $request) {
        $id = $request->id;
        $validator = Validator::make($request->all(), [
            'title' => [
                'required',
                Rule::unique('lang_translate_label')->ignore($id),
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $this->model::findOrFail($request->id);
        
        $data->title = $request->title;
        $data->save();
        flash('Record has been updated!')->success();
        
        return \redirect(route('admin.language.translate.label'));
    }

    
}

