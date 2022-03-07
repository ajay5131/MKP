<?php

namespace App\Http\Controllers\Backend;

use DataTables;
use App\Http\Controllers\Controller;
use App\Models\Backend\Testimonial;
use App\Models\Backend\TestimonialDetail;
use App\Models\Backend\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Validation\Rule;
use App\Rules\ValidateArrayElement; 

class TestimonialController extends Controller
{
    public function __construct(Testimonial $testimonial)
    {
		$this->model = $testimonial;
    }

    public function index() {
        $breadcrumbs = [
            'page_title' => 'Manage Testimonials',
            'breadcrumb' => '<li> <span>Manage Testimonials</span> </li>',
            'active_page' => 'List'
        ];
        return view('backend.testimonial.index')->with('breadcrumbs', $breadcrumbs);
    }  

    public function list(Request $request) {
        
        $list = $this->model::select('*'); //orderBy('full_name');
        return Datatables::of($list)
                ->orderColumn('full_name',  'full_name $1')
                ->orderColumn('profession',  'profession $1')
                
                ->filter(function ($query) use ($request) {
                    if ($request->has('full_name') && !empty($request->full_name)) {
                        $query->where('full_name', 'like', "%{$request->get('full_name')}%");
                    }
                    if ($request->has('profession') && !empty($request->profession)) {
                        $query->where('profession', 'like', "%{$request->get('profession')}%");
                    }
                })
                ->addColumn('media', function ($list) {
                    return '<img src="'. asset('uploads/testimonails/'.$list->media) .'" height="60" alt="">';
                })
                ->addColumn('full_name', function ($list) {
                    return $list->full_name;
                })
                ->addColumn('profession', function ($list) {
                    return $list->profession;
                })
                ->addColumn('action', function ($list) {
                    return '
                        <div class="btn-group">
                            <button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="' . route('admin.edit.testimonial', ['id' => $list->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
                                </li>						
                                <li>
                                    <a href="javascript:void(0);" onclick="deleteRecord(' . $list->id .');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
                                </li>
                            </ul>
                        </div>';
                })
                ->rawColumns(['media', 'full_name', 'profession','action'])
                ->setRowId(function($list) {
                    return 'testimonialDtRow' . $list->id;
                })->make(true);
    }

    public function add() {
        $languages = Language::orderBy('language')->pluck('language as title', 'id')->toArray();
        $breadcrumbs = [
            'page_title' => 'Manage Testimonials',
            'breadcrumb' => '<li> <a href="'.route('admin.testimonial').'">Manage Testimonials</a> <i class="fa fa-circle"></i> </li><li> <span>Add</span> </li>',
            'active_page' => 'Add'
        ];
        return view('backend.testimonial.add')->with('breadcrumbs', $breadcrumbs)->with('languages', $languages);
    }
    
    public function edit($id) {
        $languages = Language::orderBy('language')->pluck('language as title', 'id')->toArray();
        $detail = $this->model::findOrFail($id);
        $lang_detail = TestimonialDetail::where('testimonials_id', $id)->get();
        $breadcrumbs = [
            'page_title' => 'Manage Testimonials',
            'breadcrumb' => '<li> <a href="'.route('admin.testimonial').'">Manage Testimonials</a> <i class="fa fa-circle"></i> </li><li> <span>Edit</span> </li>',
            'active_page' => 'Edit'
        ];
        return view('backend.testimonial.edit')->with('detail', $detail)->with('breadcrumbs', $breadcrumbs)->with('languages', $languages)->with('lang_detail', $lang_detail);
    }
    
    public function save(Request $request) {
        $validator = Validator::make($request->all(), [
            'language_id' => [new ValidateArrayElement(), 'required'],
            'full_name' => [new ValidateArrayElement(), 'required', 'unique:testimonials'],
            'media' => 'required|mimes:jpeg,jpg,png',
            'profession' => [new ValidateArrayElement(), 'required'],
            'testimonial' => [new ValidateArrayElement(), 'required']
        ]);        

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $data = new $this->model();
        $data->full_name = $request->full_name[0];
        $data->language_id = $request->language_id[0];
        // $data->full_name_fr = $request->full_name_fr;
        $data->profession = $request->profession[0];
        // $data->profession_fr = $request->profession_fr;
        $data->testimonial = $request->testimonial[0];
        // $data->testimonial_fr = $request->testimonial_fr;
        $data->tag_id = $request->tag_id;

        // Upload media
        $upload_video_link =  $request->file('media');
        $extension = $request->file('media')->getClientOriginalExtension();
        $dir = public_path() .'/uploads/testimonails/';
        $filename = uniqid() . '_' . time() . '.' . $extension;
        $var = $request->file('media')->move($dir, $filename);
        
        $data->media = $filename;

        $data->save();

        for ($i=1; $i < count($request->language_id) ; $i++) { 
            if(!empty($request->language_id[$i]) && !empty($request->full_name[$i]) && !empty($request->profession[$i])) {
                $detail = new TestimonialDetail();
                $detail->testimonials_id = $data->id;
                $detail->language_id = $request->language_id[$i];
                $detail->full_name = $request->full_name[$i];
                $detail->testimonial = $request->testimonial[$i];
                $detail->profession = $request->profession[$i];
                $detail->save();
            }
        }
        
        flash('Record has been added!')->success();
        
        return \redirect(route('admin.testimonial'));
    }
    
    public function update(Request $request) {
        $id = $request->id;
        $title = $request->full_name[0];

        $validator = Validator::make($request->all(), [
            'language_id' => [new ValidateArrayElement(), 'required'],
            'full_name' => [
                'required',
                Rule::unique('testimonials')->where(function ($query) use($id,$title) {
                    return $query->where('full_name', $title)
                    ->where('id', '!=',  $id);
                })
            ],
            'profession' => [new ValidateArrayElement(), 'required'],
            'testimonial' => [new ValidateArrayElement(), 'required']
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        
        $data = $this->model::findOrFail($request->id);
        $data->language_id = $request->language_id[0];
        $data->full_name = $request->full_name[0];
        // $data->full_name_fr = $request->full_name_fr;
        $data->profession = $request->profession[0];
        // $data->profession_fr = $request->profession_fr;
        $data->testimonial = $request->testimonial[0];
        // $data->testimonial_fr = $request->testimonial_fr;
        $data->tag_id = $request->tag_id;
        
        if(!empty($request->media)) {

            // Upload media
            $upload_video_link =  $request->file('media');
            $extension = $request->file('media')->getClientOriginalExtension();
            $dir = public_path() .'/uploads/testimonails/';
            $filename = uniqid() . '_' . time() . '.' . $extension;
            $var = $request->file('media')->move($dir, $filename);
            
            $data->media = $filename;

        }

        $data->save();
        
        TestimonialDetail::where('testimonials_id', $request->id)->delete();

        for ($i=1; $i < count($request->language_id) ; $i++) { 
            if(!empty($request->language_id[$i]) && !empty($request->full_name[$i]) && !empty($request->profession[$i])) {
                $detail = new TestimonialDetail();
                $detail->testimonials_id = $request->id;
                $detail->language_id = $request->language_id[$i];
                $detail->full_name = $request->full_name[$i];
                $detail->testimonial = $request->testimonial[$i];
                $detail->profession = $request->profession[$i];
                $detail->save();
            }
        }

        flash('Record has been updated!')->success();
        
        return \redirect(route('admin.testimonial'));
    }
    
    public function delete(Request $request) {
        $this->model::findOrFail($request->id)->delete();
        TestimonialDetail::where('our_team_id', $request->id)->delete();
        echo "ok";
    }

    
    
}

