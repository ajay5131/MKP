<?php

namespace App\Http\Controllers\Backend;

use DataTables;
use App\Http\Controllers\Controller;
use App\Models\Backend\Pages;
use App\Models\Backend\Language;
use App\Models\Backend\PagesDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Validation\Rule;
use App\Rules\ValidateArrayElement;

class PagesController extends Controller
{
    public function __construct(Pages $pages)
    {
		$this->model = $pages;
    }

    public function index() {
        
        $breadcrumbs = [
            'page_title' => 'Manage Page Content',
            'breadcrumb' => '<li> <span>Manage Page Content</span> </li>',
            'active_page' => 'List'
        ];
        return view('backend.pages.index')->with('breadcrumbs', $breadcrumbs);
    }  

    public function list(Request $request) {
        
        $list = $this->model::select('*');//orderBy('title');
        return Datatables::of($list)
                ->orderColumn('title',  'title $1')
                ->orderColumn('sub_title',  'sub_title $1')
                ->orderColumn('description',  'description $1')

                ->filter(function ($query) use ($request) {
                    if ($request->has('title') && !empty($request->title)) {
                        $query->where('title', 'like', "%{$request->get('title')}%");
                    }
                    if ($request->has('sub_title') && !empty($request->sub_title)) {
                        $query->where('sub_title', 'like', "%{$request->get('sub_title')}%");
                    }
                })
                ->addColumn('title', function ($list) {
                    return $list->title;
                })
                ->addColumn('sub_title', function ($list) {
                    return $list->sub_title;
                })
                ->addColumn('description', function ($list) {
                    return  substr(strip_tags($list->description), 0, 150) . (strlen($list->description) > 150 ? '...' : '');
                })
                ->addColumn('action', function ($list) {
                    return '
                        <div class="btn-group">
                            <button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="' . route('admin.edit.pagecontent', ['id' => $list->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
                                </li>						
                            </ul>
                        </div>';
                })
                ->rawColumns(['title', 'sub_title', 'description', 'action'])
                ->setRowId(function($list) {
                    return 'pagesDtRow' . $list->id;
                })->make(true);
    }

    
    public function edit($id) {
        
        $languages = Language::orderBy('language')->pluck('language as title', 'id')->toArray();

        $detail = $this->model::findOrFail($id);
        $lang_detail = PagesDetail::where('page_contents_id', $id)->get();
        
        $breadcrumbs = [
            'page_title' => 'Manage Page Content',
            'breadcrumb' => '<li> <a href="'.route('admin.pagecontent').'">Manage Page Content</a> <i class="fa fa-circle"></i> </li><li> <span>Edit</span> </li>',
            'active_page' => 'Edit'
        ];
        return view('backend.pages.edit')->with('detail', $detail)->with('breadcrumbs', $breadcrumbs)->with('languages', $languages)->with('lang_detail', $lang_detail);
    }
    
    
    public function update(Request $request) {
    
        $validator = Validator::make($request->all(), [
            'language_id' => [new ValidateArrayElement(), 'required'],
            'description' => [new ValidateArrayElement(), 'required']
        ]);


        $data = $this->model::findOrFail($request->id);
        
        $data->language_id = $request->language_id[0];
        $data->sub_title = $request->sub_title[0];
        // $data->sub_title_fr = $request->sub_title_fr;
        $data->description = $request->description[0];
        // $data->description_fr = $request->description_fr;
        $data->save();
        
        PagesDetail::where('page_contents_id', $request->id)->delete();

        for ($i=1; $i < count($request->language_id) ; $i++) { 
            if(!empty($request->language_id[$i]) && !empty($request->description[$i]) ) {
                $detail = new PagesDetail();
                $detail->page_contents_id = $request->id;
                $detail->language_id = $request->language_id[$i];
                $detail->sub_title = $request->sub_title[$i];
                $detail->description = $request->description[$i];
                $detail->save();
            }
        }
        
        flash('Record has been updated!')->success();
        
        return \redirect(route('admin.pagecontent'));
    }
    
}

