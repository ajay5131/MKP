<?php

namespace App\Http\Controllers\Backend;

use DataTables;
use App\Http\Controllers\Controller;
use App\Models\Backend\Slider;
use App\Models\Backend\SliderDetail;
use App\Models\Backend\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Validation\Rule; 

class SliderController extends Controller
{
    public function __construct(Slider $slider)
    {
		$this->model = $slider;
    }

    public function index() {
        $slider_type = ['All' => 'All', 'Public' => 'Public', 'Discover' => 'Discover', 'Blog' => 'Blog', 'Opportunities' => 'Opportunities', 'Crowdfunding' => 'Crowdfunding' ];
        $breadcrumbs = [
            'page_title' => 'Manage Slider',
            'breadcrumb' => '<li> <span>Manage Slider</span> </li>',
            'active_page' => 'List'
        ];
        return view('backend.slider.index')->with('breadcrumbs', $breadcrumbs)->with('slider_type', $slider_type);
    }  

    public function list(Request $request) {
        
        $list = $this->model::select('*');//orderBy('title');
        return Datatables::of($list)
                ->orderColumn('title',  'title $1')
                ->orderColumn('slider_type',  'slider_type $1')

                ->filter(function ($query) use ($request) {
                    if ($request->has('title') && !empty($request->title)) {
                        $query->where('title', 'like', "%{$request->get('title')}%");
                    }
                    if ($request->has('slider_type') && !empty($request->slider_type)) {
                        if($request->get('slider_type') != "All") {
                            $query->where('slider_type', $request->get('slider_type'));
                        }
                    }
                    
                })
                ->addColumn('media', function ($list) {
                    if($list->media_type == 'mp4') {
                        return '<video width="80" height="60"  controls>
                            <source src="'. asset('uploads/slider/'.$list->media).'" type="video/mp4">
                        </video>';
                    } else {
                        return '<img src="'. asset('uploads/slider/'.$list->media) .'" height="60" alt="">';
                    }
                })
                ->addColumn('slider_type', function ($list) {
                    return $list->slider_type;
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
                                    <a href="' . route('admin.edit.slider', ['id' => $list->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
                                </li>						
                                <li>
                                    <a href="javascript:void(0);" onclick="deleteRecord(' . $list->id .');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
                                </li>
                            </ul>
                        </div>';
                })
                ->rawColumns(['media', 'slider_type', 'title', 'action'])
                ->setRowId(function($list) {
                    return 'sliderDtRow' . $list->id;
                })->make(true);
    }

    public function add() {

        $slider_type = ['All' => 'All', 'Public' => 'Public', 'Discover' => 'Discover', 'Blog' => 'Blog', 'Opportunities' => 'Opportunities', 'Crowdfunding' => 'Crowdfunding' ];
        $languages = Language::orderBy('language')->pluck('language as title', 'id')->toArray();
        $breadcrumbs = [
            'page_title' => 'Manage Slider',
            'breadcrumb' => '<li> <a href="'.route('admin.slider').'">Manage Slider</a> <i class="fa fa-circle"></i> </li><li> <span>Add</span> </li>',
            'active_page' => 'Add'
        ];
        return view('backend.slider.add')->with('breadcrumbs', $breadcrumbs)->with('slider_type', $slider_type)->with('languages', $languages);
    }
    
    public function edit($id) {

        $slider_type = ['All' => 'All', 'Public' => 'Public', 'Discover' => 'Discover', 'Blog' => 'Blog', 'Opportunities' => 'Opportunities', 'Crowdfunding' => 'Crowdfunding' ];

        $detail = $this->model::findOrFail($id);
        $languages = Language::orderBy('language')->pluck('language as title', 'id')->toArray();
        $slider_detail = SliderDetail::where('slider_id', $id)->get();
        $breadcrumbs = [
            'page_title' => 'Manage Slider',
            'breadcrumb' => '<li> <a href="'.route('admin.slider').'">Manage Slider</a> <i class="fa fa-circle"></i> </li><li> <span>Edit</span> </li>',
            'active_page' => 'Edit'
        ];
        return view('backend.slider.edit')->with('detail', $detail)->with('breadcrumbs', $breadcrumbs)->with('slider_type', $slider_type)->with('languages', $languages)->with('slider_detail', $slider_detail);
    }
    
    public function save(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'slider_type' => ['required'],
            'media' => ['required', 'mimes:jpeg,jpg,png,mp4'],
            'is_active' => ['required'],
            'show_more_btn_link' => ['url']
        ],
        [
            'show_more_btn_link.url' => 'Invalid url!'   
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = new $this->model();
        $data->language_id = !empty($request->language_id[0]) ? $request->language_id[0] : '';
        $data->slider_type = $request->slider_type;        
        $data->title = !empty($request->title[0]) ? $request->title[0] : '';
        $data->description = !empty($request->description[0]) ? $request->description[0] : '';
        $data->show_more_btn_link = $request->show_more_btn_link;
        $data->is_active = $request->is_active;

        // Upload media
        $upload_video_link =  $request->file('media');
        $extension = $request->file('media')->getClientOriginalExtension();
        $dir = public_path() .'/uploads/slider/';
        $filename = uniqid() . '_' . time() . '.' . $extension;
        $var = $request->file('media')->move($dir, $filename);
        
        $data->media = $filename;
        $data->media_type = $extension;

        $data->save();

        
        if(count($request->language_id) >= 2) {
            for ($i=1; $i < count($request->language_id) ; $i++) { 
                if(!empty($request->language_id[$i]) && !empty($request->title[$i]) && !empty($request->description[$i])) {
                    $detail = new SliderDetail();
                    $detail->slider_id = $data->id;
                    $detail->language_id = $request->language_id[$i];
                    $detail->title = $request->title[$i];
                    $detail->description = $request->description[$i];
                    $detail->save();
                }
            }
        }
        
        flash('Record has been added!')->success();
        
        return \redirect(route('admin.slider'));
    }
    
    public function update(Request $request) {
        
        if(!empty($request->media)) {

            $validator = Validator::make($request->all(), [
                'slider_type' => ['required'],
                'media' => ['required', 'mimes:jpeg,jpg,png,mp4'],
                'is_active' => ['required'],
                'show_more_btn_link' => ['url']
            ],
            [
                'show_more_btn_link.url' => 'Invalid url!'   
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        } else {
            $validator = Validator::make($request->all(), [
                'slider_type' => ['required'],
                'is_active' => ['required'],
                'show_more_btn_link' => ['url']
            ],
            [
                'show_more_btn_link.url' => 'Invalid url!'   
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        $data = $this->model::findOrFail($request->id);
        
        $data->language_id = !empty($request->language_id[0]) ? $request->language_id[0] : '';        
        $data->slider_type = $request->slider_type;        
        $data->title = !empty($request->title[0]) ? $request->title[0] : '';
        $data->description = !empty($request->description[0]) ? $request->description[0] : '';
        $data->show_more_btn_link = $request->show_more_btn_link;
        $data->is_active = $request->is_active;

        if(!empty($request->media)) {
            // Upload media
            $upload_video_link =  $request->file('media');
            $extension = $request->file('media')->getClientOriginalExtension();
            $dir = public_path() .'/uploads/slider/';
            $filename = uniqid() . '_' . time() . '.' . $extension;
            $var = $request->file('media')->move($dir, $filename);
            
            $data->media = $filename;
            $data->media_type = $extension;

        }

        $data->save();

        SliderDetail::where('slider_id', $request->id)->delete();

        if(count($request->language_id) >= 2) {
            for ($i=1; $i < count($request->language_id) ; $i++) { 
                if(!empty($request->language_id[$i]) && !empty($request->title[$i]) && !empty($request->description[$i])) {
                    $detail = new SliderDetail();
                    $detail->slider_id = $request->id;
                    $detail->language_id = $request->language_id[$i];
                    $detail->title = $request->title[$i];
                    $detail->description = $request->description[$i];
                    $detail->save();
                }
            }
        }
        
        flash('Record has been updated!')->success();
        
        return \redirect(route('admin.slider'));
    }
    
    public function delete(Request $request) {
        $this->model::findOrFail($request->id)->delete();
        SliderDetail::where('slider_id', $request->id)->delete();
        echo "ok";
    }

    
}

