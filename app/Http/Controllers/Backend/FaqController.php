<?php

namespace App\Http\Controllers\Backend;

use DataTables;
use App\Http\Controllers\Controller;
use App\Models\Backend\Faq;
use App\Models\Backend\FaqDetail;
use App\Models\Backend\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Validation\Rule;
use App\Rules\ValidateArrayElement;

class FaqController extends Controller
{
    public function __construct(Faq $faq)
    {
		$this->model = $faq;
    }

    public function index() {
        $breadcrumbs = [
            'page_title' => 'Manage Faqs',
            'breadcrumb' => '<li> <span>Manage Faqs</span> </li>',
            'active_page' => 'List'
        ];
        return view('backend.faq.index')->with('breadcrumbs', $breadcrumbs);
    }  

    public function list(Request $request) {
        
        $list = $this->model::select('*');//orderBy('question');
        return Datatables::of($list)
                ->orderColumn('question',  'question $1')
                ->orderColumn('answer',  'answer $1')
                ->orderColumn('sort_order',  'sort_order $1')
                ->filter(function ($query) use ($request) {
                    if ($request->has('question') && !empty($request->question)) {
                        $query->where('question', 'like', "%{$request->get('question')}%");
                    }
                })
                ->addColumn('question', function ($list) {
                    return $list->question;
                })
                ->addColumn('answer', function ($list) {
                    return substr(strip_tags($list->answer), 0, 150) . (strlen($list->answer) > 150 ? '...' : '');
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
                                    <a href="' . route('admin.edit.faq', ['id' => $list->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
                                </li>						
                                <li>
                                    <a href="javascript:void(0);" onclick="deleteRecord(' . $list->id .');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
                                </li>
                            </ul>
                        </div>';
                })
                ->rawColumns(['question', 'answer', 'sort_order', 'action'])
                ->setRowId(function($list) {
                    return 'faqDtRow' . $list->id;
                })->make(true);
    }

    public function add() {
        $languages = Language::orderBy('language')->pluck('language as title', 'id')->toArray();

        $breadcrumbs = [
            'page_title' => 'Manage Faqs',
            'breadcrumb' => '<li> <a href="'.route('admin.faq').'">Manage Faqs</a> <i class="fa fa-circle"></i> </li><li> <span>Add</span> </li>',
            'active_page' => 'Add'
        ];
        return view('backend.faq.add')->with('breadcrumbs', $breadcrumbs)->with('languages', $languages);
    }
    
    public function edit($id) {
        $languages = Language::orderBy('language')->pluck('language as title', 'id')->toArray();

        $detail = $this->model::findOrFail($id);
        $lang_detail = FaqDetail::where('faq_id', $id)->get();
        $breadcrumbs = [
            'page_title' => 'Manage Faqs',
            'breadcrumb' => '<li> <a href="'.route('admin.faq').'">Manage Faqs</a> <i class="fa fa-circle"></i> </li><li> <span>Edit</span> </li>',
            'active_page' => 'Edit'
        ];
        return view('backend.faq.edit')->with('detail', $detail)->with('breadcrumbs', $breadcrumbs)->with('languages', $languages)->with('lang_detail', $lang_detail);
    }
    
    public function save(Request $request) {
        $validator = Validator::make($request->all(), [
            'language_id' => [new ValidateArrayElement(), 'required'],
            'question' => [new ValidateArrayElement(), 'required', 'unique:faq','max:255'],
            'answer' => [new ValidateArrayElement(), 'required']
        ]);        

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = new $this->model();
        $data->language_id = $request->language_id[0];
        $data->question = $request->question[0];
        // $data->question_fr = $request->question_fr;
        $data->answer = $request->answer[0];
        // $data->answer_fr = $request->answer_fr;

        $sort_order = 1;
        $max_order = $this->model::max('sort_order');
        if(!empty($max_order)) {
            $sort_order = ($max_order + 1);
        }
        $data->sort_order = $sort_order;

        $data->save();
        
        for ($i=1; $i < count($request->language_id) ; $i++) { 
            if(!empty($request->language_id[$i]) && !empty($request->question[$i]) && !empty($request->answer[$i])) {
                $detail = new FaqDetail();
                $detail->faq_id = $data->id;
                $detail->language_id = $request->language_id[$i];
                $detail->question = $request->question[$i];
                $detail->answer = $request->answer[$i];
                $detail->save();
            }
        }

        flash('Record has been added!')->success();
        
        return \redirect(route('admin.faq'));
    }
    
    public function update(Request $request) {
        $id = $request->id;
        $title = $request->question[0];

        $validator = Validator::make($request->all(), [
            'question' => [
                new ValidateArrayElement(),
                'required',
                Rule::unique('faq')->where(function ($query) use($id,$title) {
                    return $query->where('question', $title)
                    ->where('id', '!=',  $id);
                })
            ],
            'answer' => [new ValidateArrayElement(), 'required']
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $this->model::findOrFail($request->id);
        $data->language_id = $request->language_id[0];
        $data->question = $request->question[0];
        // $data->question_fr = $request->question_fr;
        $data->answer = $request->answer[0];
        // $data->answer_fr = $request->answer_fr;
        
        $data->save();

        FaqDetail::where('faq_id', $request->id)->delete();

        for ($i=1; $i < count($request->language_id) ; $i++) { 
            if(!empty($request->language_id[$i]) && !empty($request->question[$i]) && !empty($request->answer[$i])) {
                $detail = new FaqDetail();
                $detail->faq_id = $request->id;
                $detail->language_id = $request->language_id[$i];
                $detail->question = $request->question[$i];
                $detail->answer = $request->answer[$i];
                $detail->save();
            }
        }
        
        flash('Record has been updated!')->success();
        
        return \redirect(route('admin.faq'));
    }
    
    public function delete(Request $request) {
        $this->model::findOrFail($request->id)->delete();
        FaqDetail::where('faq_id', $request->id)->delete();
        echo "ok";
    }

    public function sort() {
        $breadcrumbs = [
            'page_title' => 'Manage Faqs',
            'breadcrumb' => '<li> <a href="'.route('admin.faq').'">Manage Faqs</a> <i class="fa fa-circle"></i> </li><li> <span>Sort</span> </li>',
            'active_page' => 'Sort'
        ];
        return view('backend.faq.sort')->with('breadcrumbs', $breadcrumbs);
    }

    public function getFaqSortData(Request $request) {
        $faq = $this->model::orderBy('sort_order')->get();

        $html = '';
        if (count($faq) > 0) {
            $html = '<ul id="sortable" class="sortable">';
            foreach ($faq as $val) {
                $html .= "<li id='$val->id'><i class='fa fa-sort'></i><strong>".ucwords($val->question)."</strong></li>";
            }
            $html .= '</ul>';
        } else {
            $html = '<p class="pl-1">No data found!</p>';
        }

        echo $html;
    }
    public function sortUpdate(Request $request) {
        $order_array = explode(',', $request->sort_order);
        foreach ($order_array as $k => $id) {
            $this->model::where('id',$id)->update(['sort_order'=>$k+1]);
        }
    }

    
}

