<?php

namespace App\Http\Controllers\Backend;

use DataTables;
use App\Http\Controllers\Controller;
use App\Models\Backend\News;
use App\Models\Backend\Language;
use App\Models\Backend\NewsDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Validation\Rule; 
use App\Rules\ValidateArrayElement;

class NewsController extends Controller
{
    public function __construct(News $news)
    {
		$this->model = $news;
    }

    public function index() {
        $breadcrumbs = [
            'page_title' => 'Manage News',
            'breadcrumb' => '<li> <span>Manage News</span> </li>',
            'active_page' => 'List'
        ];
        return view('backend.news.index')->with('breadcrumbs', $breadcrumbs);
    }  

    public function list(Request $request) {
        
        $list = $this->model::select('*');
        return Datatables::of($list)
                ->orderColumn('title',  'title $1')
                ->filter(function ($query) use ($request) {
                    if ($request->has('title') && !empty($request->title)) {
                        $query->where('title', 'like', "%{$request->get('title')}%");
                    }
                })
                ->addColumn('media', function ($list) {
                    return '<img src="'. asset('uploads/news/'.$list->media) .'" style="width: 60px;height: auto;" alt="">';
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
                                    <a href="' . route('admin.edit.news', ['id' => $list->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
                                </li>						
                                <li>
                                    <a href="javascript:void(0);" onclick="deleteRecord(' . $list->id .');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
                                </li>
                            </ul>
                        </div>';
                })
                ->rawColumns(['media', 'title', 'action'])
                ->setRowId(function($list) {
                    return 'newsDtRow' . $list->id;
                })->make(true);
    }

    public function add() {
        $languages = Language::orderBy('language')->pluck('language as title', 'id')->toArray();
        $breadcrumbs = [
            'page_title' => 'Manage News',
            'breadcrumb' => '<li> <a href="'.route('admin.news').'">Manage News</a> <i class="fa fa-circle"></i> </li><li> <span>Add</span> </li>',
            'active_page' => 'Add'
        ];
        return view('backend.news.add')->with('breadcrumbs', $breadcrumbs)->with('languages', $languages);
    }
    
    public function edit($id) {

        $detail = $this->model::findOrFail($id);
        $languages = Language::orderBy('language')->pluck('language as title', 'id')->toArray();
        $lang_detail = NewsDetail::where('news_id', $id)->get();
        $breadcrumbs = [
            'page_title' => 'Manage News',
            'breadcrumb' => '<li> <a href="'.route('admin.news').'">Manage News</a> <i class="fa fa-circle"></i> </li><li> <span>Edit</span> </li>',
            'active_page' => 'Edit'
        ];
        return view('backend.news.edit')->with('detail', $detail)->with('breadcrumbs', $breadcrumbs)->with('languages', $languages)->with('lang_detail', $lang_detail);
    }
    
    public function save(Request $request) {
        $validator = Validator::make($request->all(), [
            'language_id' => [new ValidateArrayElement(), 'required'],
            'title' => [new ValidateArrayElement(), 'required', 'unique:news', 'max:255'],
            'media' => 'required|mimes:jpeg,jpg,png',
            'description' => [new ValidateArrayElement(), 'required']
        ]);        
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $data = new $this->model();
        $data->language_id = $request->language_id[0];
        $data->title = $request->title[0];
        $data->description = $request->description[0];
        
        $data->slug = \Str::slug($request->title[0], '-');

        // Upload media
        $upload_video_link =  $request->file('media');
        $extension = $request->file('media')->getClientOriginalExtension();
        $dir = public_path() .'/uploads/news/';
        
        $filename = uniqid() . '_' . time() . '.' . $extension;
        $var = $request->file('media')->move($dir, $filename);
        
        $data->media = $filename;

        $data->save();

        for ($i=1; $i < count($request->language_id) ; $i++) { 
            if(!empty($request->language_id[$i]) && !empty($request->title[$i]) && !empty($request->description[$i])) {
                $detail = new NewsDetail();
                $detail->news_id = $data->id;
                $detail->language_id = $request->language_id[$i];
                $detail->title = $request->title[$i];
                $detail->description = $request->description[$i];
                $detail->save();
            }
        }
        
        flash('Record has been added!')->success();
        
        return \redirect(route('admin.news'));
    }
    
    public function update(Request $request) {
        $id = $request->id;
        $title = $request->title[0];

        $validator = Validator::make($request->all(), [
            'title' => [
                new ValidateArrayElement(),
                'required',
                Rule::unique('news')->where(function ($query) use($id,$title) {
                    return $query->where('title', $title)
                    ->where('id', '!=',  $id);
                })
            ],
            'description' => [new ValidateArrayElement(), 'required'],
            'language_id' => [new ValidateArrayElement(), 'required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $this->model::findOrFail($request->id);
        
        $data->language_id = $request->language_id[0];
        $data->title = $request->title[0];
        $data->description = $request->description[0];
        
        $data->slug = \Str::slug($request->title[0], '-');
        
        if(!empty($request->media)) {

            // Upload media
            $upload_video_link =  $request->file('media');
            $extension = $request->file('media')->getClientOriginalExtension();
            $dir = public_path() .'/uploads/news/';
            $filename = uniqid() . '_' . time() . '.' . $extension;
            $var = $request->file('media')->move($dir, $filename);
            
            $data->media = $filename;

        }

        $data->save();

        NewsDetail::where('news_id', $request->id)->delete();

        for ($i=1; $i < count($request->language_id) ; $i++) { 
            if(!empty($request->language_id[$i]) && !empty($request->title[$i]) && !empty($request->description[$i])) {
                $detail = new NewsDetail();
                $detail->news_id = $request->id;
                $detail->language_id = $request->language_id[$i];
                $detail->title = $request->title[$i];
                $detail->description = $request->description[$i];
                $detail->save();
            }
        }
        
        flash('Record has been updated!')->success();
        
        return \redirect(route('admin.news'));
    }
    
    public function delete(Request $request) {
        $this->model::findOrFail($request->id)->delete();
        NewsDetail::where('news_id', $request->id)->delete();
        echo "ok";
    }

    
}

