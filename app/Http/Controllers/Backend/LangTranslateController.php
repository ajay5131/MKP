<?php

namespace App\Http\Controllers\Backend;

use DataTables;
use App\Http\Controllers\Controller;
use App\Models\Backend\LangTranslateLabel;
use App\Models\Backend\Language;
use App\Models\Backend\LangTranslate;
use App\Models\Backend\LangTranslateDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Validation\Rule; 
use App\Rules\ValidateArrayElement;

class LangTranslateController extends Controller
{
    public function __construct(LangTranslate $langtranslate)
    {
		$this->model = $langtranslate;
    }

    public function index() {
        $labels = LangTranslateLabel::orderBy('title', 'ASC')->pluck('title', 'id')->toArray();
        $breadcrumbs = [
            'page_title' => 'Manage Language Translate',
            'breadcrumb' => '<li> <span>Manage Language Translate</span> </li>',
            'active_page' => 'List'
        ];
        return view('backend.langtranslate.index')->with('breadcrumbs', $breadcrumbs)->with('labels', $labels);
    }  

    public function list(Request $request) {
        
        $list = $this->model::select('lang_translate.value', 'lang_translate.id', 'lang_translate_label.title as lang_label')
        ->join('lang_translate_label', 'lang_translate_label.id', '=', 'lang_translate.lang_translate_label_id');
        // orderBy('lang_translate_label.title')->
        return Datatables::of($list)
                ->orderColumn('lang_label',  'lang_label $1')
                ->orderColumn('value',  'value $1')
                
                ->filter(function ($query) use ($request) {
                    if ($request->has('title') && !empty($request->title)) {
                        $query->where('value', 'like', "%{$request->get('title')}%");
                    }
                    if ($request->has('label_id') && !empty($request->label_id)) {
                        $query->where('lang_translate_label.id', $request->get('label_id'));
                    }

                })
                ->addColumn('lang_label', function ($list) {
                    return $list->lang_label;
                })
                ->addColumn('value', function ($list) {
                    return $list->value;
                })
                ->addColumn('action', function ($list) {
                    return '
                        <div class="btn-group">
                            <button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="' . route('admin.edit.language.translate', ['id' => $list->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
                                </li>						
                                
                            </ul>
                        </div>';
                })
                // <li>
                //     <a href="javascript:void(0);" onclick="deleteRecord(' . $list->id .');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
                // </li>
                ->rawColumns(['lang_label', 'value', 'action'])
                ->setRowId(function($list) {
                    return 'tableDtRow' . $list->id;
                })->make(true);
    }

    public function add() {

        $labels = LangTranslateLabel::orderBy('title', 'ASC')->pluck('title', 'id')->toArray();
        $languages = Language::orderBy('language', 'ASC')->pluck('language as title', 'id')->toArray();
        $breadcrumbs = [
            'page_title' => 'Manage Language Translate',
            'breadcrumb' => '<li> <a href="'.route('admin.language.translate').'">Manage Language Translate</a> <i class="fa fa-circle"></i> </li><li> <span>Add</span> </li>',
            'active_page' => 'Add'
        ];
        return view('backend.langtranslate.add')->with('breadcrumbs', $breadcrumbs)->with('labels', $labels)->with('languages', $languages);
    }
    
    public function edit($id) {

        $detail = $this->model::findOrFail($id);
        $labels = LangTranslateLabel::orderBy('title', 'ASC')->pluck('title', 'id')->toArray();
        $languages = Language::orderBy('language', 'ASC')->pluck('language as title', 'id')->toArray();
        $lang_detail = LangTranslateDetail::where('lang_translate_id', $id)->get();
        $breadcrumbs = [
            'page_title' => 'Manage Language Translate',
            'breadcrumb' => '<li> <a href="'.route('admin.language.translate').'">Manage Language Translate</a> <i class="fa fa-circle"></i> </li><li> <span>Edit</span> </li>',
            'active_page' => 'Edit'
        ];
        return view('backend.langtranslate.edit')->with('detail', $detail)->with('breadcrumbs', $breadcrumbs)->with('labels', $labels)->with('languages', $languages)->with('lang_detail', $lang_detail);
    }
    
    public function save(Request $request) {
        
        // $validator = Validator::make($request->all(), [
        //     'country_id' => 'required',
        //     'title' => 'required|unique:state,country_id|max:255',
        // ]);
        $value = $request->value;
        $lang_translate_label_id = $request->lang_translate_label_id;
        $language_id = $request->language_id;
        
        $validator = Validator::make($request->all(), [
            'language_id' => [new ValidateArrayElement(), 'required'],
            'lang_translate_label_id' => [
                'required',
            ],
            'value' => [
                new ValidateArrayElement(),
                'required',
            ],
        ],
        [
            'language_id.required' => 'The language field is required.',   
            'lang_translate_label_id.required' => 'The label field is required.',   
            'lang_translate_label_id.unique' => 'The language and label has already been taken.',   
            'value.required' => 'The title field is required.',   
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        

        $data = new $this->model();
        $data->language_id = $request->language_id[0];        
        $data->lang_translate_label_id = $request->lang_translate_label_id;        
        $data->value = $request->value[0];
        $data->save();

        // creation of language file and insert data into it
        $this->createLangFile($request->language_id[0], 0);
        
        for ($i=1; $i < count($request->language_id) ; $i++) { 
            if(!empty($request->language_id[$i]) && !empty($request->value[$i]) ) {
                $detail = new LangTranslateDetail();
                $detail->lang_translate_id = $data->id;
                $detail->language_id = $request->language_id[$i];
                $detail->value = $request->value[$i];
                $detail->save();
                $this->createLangFile($request->language_id[$i], 1);
            }
        }
        
        flash('Record has been added!')->success();
        
        return \redirect(route('admin.add.language.translate'));
        // return \redirect(route('admin.language.translate'));
    }
    
    public function update(Request $request) {
        $id = $request->id;
        $value = $request->value;
        $lang_translate_label_id = $request->lang_translate_label_id;
        $language_id = $request->language_id;

        $validator = Validator::make($request->all(), [
            'language_id' => [new ValidateArrayElement(), 'required'],
            'lang_translate_label_id' => [
                'required',
            ],
            'value' => [
                new ValidateArrayElement(),
                'required',
            ],
        ],
        [
            'language_id.required' => 'The language field is required.',   
            'lang_translate_label_id.required' => 'The label field is required.',   
            'lang_translate_label_id.unique' => 'The language and label has already been taken.',   
            'value.required' => 'The title field is required.',   
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $this->model::findOrFail($request->id);
        
        $data->language_id = $request->language_id[0];
        $data->lang_translate_label_id = $request->lang_translate_label_id;
        $data->value = $request->value[0];
        $data->save();

        // creation of language file and insert data into it
        $this->createLangFile($request->language_id[0], 0);
        
        LangTranslateDetail::where('lang_translate_id', $request->id)->delete();

        for ($i=1; $i < count($request->language_id) ; $i++) { 
            if(!empty($request->language_id[$i]) && !empty($request->value[$i]) ) {
                $detail = new LangTranslateDetail();
                $detail->lang_translate_id = $request->id;
                $detail->language_id = $request->language_id[$i];
                $detail->value = $request->value[$i];
                $detail->save();

                $this->createLangFile($request->language_id[$i], 1);
            }
        }

        flash('Record has been updated!')->success();
        
        return \redirect(route('admin.language.translate'));
    }

    
    private function createLangFile($language_id, $is_defult) {
        // Creation of directory and file if not exist to change the language
        $langs = Language::where('id', $language_id)->pluck('code')->toArray();
        $path = base_path().'/resources/lang/'.$langs[0];
        if (!\File::exists($path)){
            $result = \File::makeDirectory($path);
        }
    
        // Create content to store into file.
        $data = $this->model::where('lang_translate.language_id', $language_id)->orderBy('lang_translate_label.id')->select('lang_translate.value as val', 'lang_translate_label.title as label')
                            ->join('lang_translate_label', 'lang_translate_label.id', '=', 'lang_translate.lang_translate_label_id')->get();
        if($is_defult == 1) {
            $data = $this->model::where('lang_translate_detail.language_id', $language_id)->orderBy('lang_translate_label.id')->select('lang_translate_detail.value as val', 'lang_translate_label.title as label')
                            ->join('lang_translate_detail', 'lang_translate_detail.lang_translate_id', '=', 'lang_translate.id')
                            ->join('lang_translate_label', 'lang_translate_label.id', '=', 'lang_translate.lang_translate_label_id')->get();
            
        }
        
        $content = '';
        foreach ($data as $key => $value) {
            $content .= '"' . $value->label .'" => "'. $value->val.'",';
            $content .= "\n";
        }

        if(!\File::exists($path .'/messages.php')) {
            \File::put($path .'/messages.php', "<?php \nreturn [\n".$content."\n];");
        } else {
            \File::put($path .'/messages.php', "<?php \nreturn [\n".$content."\n];");
        }
        
    }
    
    public function delete(Request $request) {
        $this->model::findOrFail($request->id)->delete();
        LangTranslateDetail::where('lang_translate_id', $request->id)->delete();
        echo "ok";
    }

    
}

