<?php

namespace App\Http\Controllers\Publichome;
use App;
use Mail;
use App\Mail\ContactUsEmail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Publichome\SliderView;
use App\Models\Backend\Pages;
use App\Models\Backend\PagesDetail;
use App\Models\Publichome\TeamView;
use App\Models\Publichome\NewsView;
use App\Models\Publichome\ServiceView;
use App\Models\Backend\Team;
use App\Models\Backend\Language;
use App\Models\Publichome\Services;
use App\Models\Publichome\ServicesDetail;
use App\Models\Publichome\Contact;
use App\Models\Publichome\TestimonailView;
use App\Models\Publichome\FaqView;
use App\Models\Publichome\PageContentView;
use App\Rules\ValidateArrayElement;

class HomeController extends Controller
{
    public function __construct(SliderView $slider, Pages $pages, ServiceView $service)
    {
        $this->slider = $slider;
        $this->pages = $pages;
        $this->service = $service;
    }

    public function index() {

        $slider = $this->slider::where('is_active', 1)->where('language_id', \Session::get('lang_id'))->whereIn('slider_type', ['All', 'Public'])->orderByDesc('id')->get();
        $eng_pages = PageContentView::orderBy('id')->where('language_id', '44')->get();
        
        $overview = PageContentView::orderBy('id')->where('id', 6)->where('language_id', \Session::get('lang_id'))->first();

        $service_title = PageContentView::orderBy('id')->where('id', 5)->where('language_id', \Session::get('lang_id'))->first();
        
        $about = PageContentView::orderBy('id')->where('id', 4)->where('language_id', \Session::get('lang_id'))->first();

        $service = $this->service::orderBy('id')->where('language_id', \Session::get('lang_id'))->get();

        return view('public.home.index')->with('slider', $slider)->with('overview', $overview)->with('service_title', $service_title)->with('about', $about)->with('eng_page_contents', $eng_pages)->with('service', $service);
    }  

    public function changeLanguage(Request $request) {
        if($request->ajax()){
            if($request->locale == 'en') {
                App::setLocale($request->locale);
                $request->session()->put('direction', 0);
                $request->session()->put('lang_id', 44);
            } else {
                $langs = Language::findorFail($request->locale);
    
                $request->session()->put('locale', $langs->code);
                $request->session()->put('direction', $langs->direction);
                $request->session()->put('lang_id', $request->locale);

                App::setLocale($langs->code);
            }

            echo 'success';
         }
    }

    public function updateOverview(Request $request) {
        $validator = Validator::make($request->all(), [
            'language_id' => [new ValidateArrayElement(), 'required'],
            'sub_title' => [new ValidateArrayElement(), 'required'],
            'description' => [new ValidateArrayElement(), 'required'],
        ],
        [
            'sub_title.required' => 'The title field is required.',
            'sub_title_fr.required' => 'The title in french field is required.',
            'description.required' => 'The description field is required.',
            'description_fr.required' => 'The description in french field is required.',
        ]);
        if ($validator->passes()) {
            if(!empty($request->update_id)) {
                
                $data = $this->pages::where('id', $request->update_id)->first();
                $data->language_id = $request->language_id[0];
                $data->sub_title = $request->sub_title[0];
                // $data->sub_title_fr = $request->sub_title_fr;
                $data->description = $request->description[0];
                // $data->description_fr = $request->description_fr;
                $data->save();

                PagesDetail::where('page_contents_id', $request->update_id)->delete();

                for ($i=1; $i < count($request->language_id) ; $i++) { 
                    if(!empty($request->language_id[$i]) && (!empty($request->sub_title[$i]) || !empty($request->description[$i]) ) ) {
                        $detail = new PagesDetail();
                        $detail->page_contents_id = $request->update_id;
                        $detail->language_id = $request->language_id[$i];
                        $detail->sub_title = $request->sub_title[$i];
                        $detail->description = $request->description[$i];
                        $detail->save();
                    }
                }
    
                return response()->json(['success'=>'Added new records.']);

            }
        }
        return response()->json(['error'=>$validator->errors()]);
    }
    
    public function updateService(Request $request) {
        $validator = Validator::make($request->all(), [
            'language_id' => [new ValidateArrayElement(), 'required'],
            'title' => [new ValidateArrayElement(), 'required'],
            'description' => [new ValidateArrayElement(), 'required']
        ],
        [
            'title.required' => 'The title field is required.',
            'description.required' => 'The description field is required.',
        ]);

        if ($validator->passes()) {
            if(!empty($request->update_id)) {

                $data = $this->service::where('id', $request->update_id)->first();
                $data->language_id = $request->language_id[0];
                $data->title = $request->title[0];
                // $data->title_fr = $request->title_fr;
                $data->description = $request->description[0];
                // $data->description_fr = $request->description_fr;
                $data->save();

                ServicesDetail::where('home_services_id', $request->update_id)->delete();

                for ($i=1; $i < count($request->language_id) ; $i++) { 
                    if(!empty($request->language_id[$i]) && (!empty($request->title[$i]) || !empty($request->description[$i]) ) ) {
                        $detail = new ServicesDetail();
                        $detail->home_services_id = $request->update_id;
                        $detail->language_id = $request->language_id[$i];
                        $detail->title = $request->title[$i];
                        $detail->description = $request->description[$i];
                        $detail->save();
                    }
                }
    
                return response()->json(['success'=>'Added new records.']);

            }
        }
        return response()->json(['error'=>$validator->errors()]);
    }

    public function getService(Request $request) {
        
        $service = $this->service::where('id', $request->id)->where('language_id', \Session::get('lang_id'))->first();
        $service_edit = $this->service::where('id', $request->id)->where('language_id', 44)->first();

        $html = '
                <div class="update_service_detail">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <strong>'. $service->title . ((\Auth::guard('admin')->check()) ? '&nbsp;&nbsp;<a class="clear_css toggle__service_detail" href="javascript:;"><i class="fa fa-pencil"></i></a>' : '') .'</strong></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        '. $service->description .'
                    </div>
                </div>';
        
        $languages = \General::getAllLanguage();
        $services_detail = ServicesDetail::where('home_services_id', $request->id)->get();

        $other_lang = '';
        if(count($services_detail) > 0) {
            foreach ($services_detail as $key => $value) {
                
                $other_lang .= '
                <div class="add_more_block">
                    <div class="form-group">
                        '. \Form::label('language_id', 'Other Language', ['class' => 'bold']).'&nbsp;'. 
                        \Form::select('language_id[]', ['' => 'Select Language']+$languages, $value->language_id, array('class'=>'form-control select2', 'required' =>'required', 'id'=>'language_id'))
                       .'
                    </div>
        
                    <div class="form-group ">
                        '.\Form::label('title', 'Title', ['class' => 'bold']).'&nbsp;'.
                        \Form::text('title[]', $value->title, array('class'=>'form-control ')) .'
                        <span id="service_title_title" class="text-danger clear_error"></span>
                    </div>
        
                    <div class="form-group">
                        '.\Form::label('description', 'Description', ['class' => 'bold']).'&nbsp;'.
                        \Form::textarea('description[]', $value->description, array('class'=>'form-control', 'rows'=>3)).'
                        <span id="service_title_description" class="text-danger clear_error"></span>
                    </div>
        
                    <div class="text-right">
                        <button class="btn btn-danger btn-sm remove_btn" type="button"><i class="fa fa-trash-o"></i></button>
                    </div>
                </div>';

            }
        }

        $response = [
            'html' => $html,
            'title' => $service_edit->title,
            // 'title_fr' => $service->title_fr,
            'description' => strip_tags($service_edit->description),
            'service_detail' => $other_lang,
            // 'description_fr' => strip_tags($service->description_fr),
        ];

        echo json_encode($response);
    }

    public function news() {
        $news = NewsView::orderByDesc('id')->where('language_id', \Session::get('lang_id'))->get();
        
        $breadcrumbs = [
            'title' => \Lang::get('messages.latestnews'),
            'breadcrumbs' => '<li class="breadcrumb-item active" aria-current="page">'.\Lang::get('messages.latestnews').'</li>',
        ];
        return view('public.news.index')->with('news', $news)->with('breadcrumbs', $breadcrumbs);
    }

    public function newsDetail($slug) {
        $news = NewsView::where('slug', $slug)->where('language_id', \Session::get('lang_id'))->first();
        
        $breadcrumbs = [
            'title' => $news->title,
            'breadcrumbs' => '<li class="breadcrumb-item active" aria-current="page"><a href="' .route('news') .'">'.\Lang::get('messages.latestnews').'</a></li>', //<li class="breadcrumb-item active" aria-current="page">'.$news->title.'</li>
        ];
        $meta = [
            'title' => $news->title,
            'description' => substr($news->description,0, 120),
            'image' => asset('/') . 'uploads/news/' . $news->media,
            'url' => route('news.detail', $news->slug),
            'card' => 'summary_large_image',
            'type' => 'article'
        ];
        return view('public.news.detail')->with('news', $news)->with('breadcrumbs', $breadcrumbs)->with('metas', $meta);
    }

    public function meetOurTeam() {
        $team = TeamView::where('team_type', 1)->where('language_id', \Session::get('lang_id'))->orderBy('sort_order')->get();
        $partner = TeamView::where('team_type', 2)->where('language_id', \Session::get('lang_id'))->orderBy('sort_order')->get();
        $mentor = TeamView::where('team_type', 3)->where('language_id', \Session::get('lang_id'))->orderBy('sort_order')->get();

        $breadcrumbs = [
            'title' => \Lang::get('messages.meetourteam'),
            'breadcrumbs' => '<li class="breadcrumb-item active" aria-current="page">'.\Lang::get('messages.meetourteam').'</li>',
        ];
        return view('public.meetourteam.index')->with('team', $team)->with('partner', $partner)->with('mentor', $mentor)->with('breadcrumbs', $breadcrumbs);
    }

    public function meetOurTeamDetail($slug) {
        $team = TeamView::where('slug', $slug)->where('language_id', \Session::get('lang_id'))->first();
        
        $breadcrumbs = [
            'title' => $team->full_name,
            'breadcrumbs' => '<li class="breadcrumb-item active" aria-current="page"><a href="' .route('meet.our.team') .'">'.\Lang::get('messages.meetourteam').'</a></li>', //<li class="breadcrumb-item active" aria-current="page">'.$news->title.'</li>
        ];
        return view('public.meetourteam.detail')->with('team', $team)->with('breadcrumbs', $breadcrumbs);//->with('metas', $meta);
    }

    public function termsCondition() {
        $detail = PageContentView::where('id', 1)->where('language_id', \Session::get('lang_id'))->first();
        
        $breadcrumbs = [
            'title' => \Lang::get('messages.termsandcondition'),
            'breadcrumbs' => '<li class="breadcrumb-item active" aria-current="page">'.\Lang::get('messages.termsandcondition').'</li>',
        ];
        return view('public.policy.detail')->with('detail', $detail)->with('breadcrumbs', $breadcrumbs);
    }
    public function termsService() {
        $detail = PageContentView::where('id', 3)->where('language_id', \Session::get('lang_id'))->first();
        $breadcrumbs = [
            'title' => \Lang::get('messages.termsofservice'),
            'breadcrumbs' => '<li class="breadcrumb-item active" aria-current="page">'.\Lang::get('messages.termsofservice').'</li>',
        ];
        return view('public.policy.detail')->with('detail', $detail)->with('breadcrumbs', $breadcrumbs);
    }
    public function privacyPolicy() {
        $detail = PageContentView::where('id', 2)->where('language_id', \Session::get('lang_id'))->first();
        $breadcrumbs = [
            'title' => \Lang::get('messages.privacypolicy'),
            'breadcrumbs' => '<li class="breadcrumb-item active" aria-current="page">'.\Lang::get('messages.privacypolicy').'</li>',
        ];
        return view('public.policy.detail')->with('detail', $detail)->with('breadcrumbs', $breadcrumbs);
    }
    
    public function testimonial() {
        $detail = TestimonailView::where('language_id', \Session::get('lang_id'))->get();
        $breadcrumbs = [
            'title' => \Lang::get('messages.testimonial'),
            'breadcrumbs' => '<li class="breadcrumb-item active" aria-current="page">'.\Lang::get('messages.testimonial').'</li>',
        ];
        return view('public.testimonial.detail')->with('detail', $detail)->with('breadcrumbs', $breadcrumbs);
    }
    
    public function faq() {
        $detail = FaqView::where('language_id', \Session::get('lang_id'))->get();
        $breadcrumbs = [
            'title' => \Lang::get('messages.faq'),
            'breadcrumbs' => '<li class="breadcrumb-item active" aria-current="page">'.\Lang::get('messages.faq').'</li>',
        ];
        return view('public.faq.detail')->with('detail', $detail)->with('breadcrumbs', $breadcrumbs);
    }

    public function contact() {
        $breadcrumbs = [
            'title' => \Lang::get('messages.contactus'),
            'breadcrumbs' => '<li class="breadcrumb-item active" aria-current="page">'.\Lang::get('messages.contactus').'</li>',
        ];
        return view('public.contact.index')->with('breadcrumbs', $breadcrumbs);
    }
    
    public function emailContact(Request $request) {
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'email' => 'required|email',
            'type' => 'required',
            'message' => 'required'
        ],
        [
            'fname.required' => 'The name field is required.'
        ]);        

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $data['fname'] = $request->input('fname');
        $data['email'] = $request->input('email');
        $data['contact'] = $request->input('contact');
        $data['type'] = $request->input('type');
        $data['message'] = $request->input('message');
        $data['country_code'] = $request->country_code;
        $data['type'] = $request->type;

        $msg_save = Contact::create($data);
        $data['messages'] = $request->input('message');
        

        // Mail::send(new ContactUsEmail($data));

        return \Redirect::route('contact.thanks');
    }

    public function thanksContact()
    {
        $breadcrumbs = [
            'title' => \Lang::get('messages.contactus'),
            'breadcrumbs' => '<li class="breadcrumb-item active" aria-current="page">'.\Lang::get('messages.contactus').'</li>',
        ];
        return view('public.contact.thanks')->with('breadcrumbs', $breadcrumbs);
    }
    
}

