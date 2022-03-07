@extends('public.layouts.layout')

@section('content')
    <section class="first-section">
        <div class="container text-center title-heading">
            <h2 class="update__overview">
                {{ !empty($overview->sub_title) ? $overview->sub_title : '' }} 
                <?php if(\Auth::guard('admin')->check()) {
                    echo '<a class="clear_css toggle__overview" href="javascript:;"><i class="fa fa-pencil"></i></a>';
                }?>
            </h2>  
            @if(\Auth::guard('admin')->check())
                <div class="update__overview text-left mt-5 mb-4 hide" >
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-12">

                            {!! Form::open(array('method' => 'post', 'route' => 'update.overview', 'class' => 'form', 'id' => 'overview__form')) !!}
                                
                                <input type="hidden" name="update_id" value="{{ $eng_page_contents[5]->id }}">
                                <input type="hidden" name="description[]" value="{{ $eng_page_contents[5]->description }}">
                                <input type="hidden" name="language_id[]" value="44">
                        
                                <div class="default__lang">
                                    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'sub_title') !!}">
                                        {!! Form::label('sub_title', 'Title', ['class' => 'bold']) !!}
                                        {!! Form::text('sub_title[]', $eng_page_contents[5]->sub_title, array('class'=>'form-control')) !!}
                                        <span id="overview_sub_title" class="text-danger clear_error"></span>
                                    </div>
                                    
                                    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'description') !!}">
                                        {!! Form::label('description', 'Description', ['class' => 'bold']) !!}
                                        {!! Form::textarea('description[]', $eng_page_contents[5]->description, array('class'=>'form-control tinymce_editor')) !!}
                                        <span id="ov_desc_description" class="text-danger clear_error"></span>
                                    </div>
                                
                                </div>

                                <div class="text-right mb-2">
                                    <button class="btn btn-warning add_more_btn" type="button"><span class="btnloader"><i class="fa fa-spinner fa-spin"></i></span> Add More</button>
                                    <input type="hidden" id="add_more_url" value="{{ route("add.more.overview.lang") }}">
                                </div>
                                <div class="add_more_lang">
                                    <?php $lang_detail = \General::getPageDetail(6); ?>
                                    <?php $languages = General::getAllLanguage(); ?>
                                    @if(isset($lang_detail))
                                        @foreach ($lang_detail as $key => $value)
                                            <div class="add_more_block">
                                                <div class="form-group">
                                                    {!! Form::label('language_id', 'Other Language', ['class' => 'bold']) !!} 
                                                    {!! Form::select('language_id[]', ['' => 'Select Language']+$languages, $value->language_id, array('class'=>'form-control select2', 'required' =>'required', 'id'=>'language_id')) !!}                   
                                                    {!! APFrmErrHelp::showErrors($errors, 'language_id') !!}
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group {!! APFrmErrHelp::hasError($errors, 'sub_title') !!}">
                                                            {!! Form::label('title', 'Title', ['class' => 'bold']) !!}                    
                                                            {!! Form::text('sub_title[]', $value->sub_title, array('class'=>'form-control', 'id'=>'title', 'required' =>'required', 'placeholder'=>'Title')) !!}
                                                            {!! APFrmErrHelp::showErrors($errors, 'sub_title') !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group {!! APFrmErrHelp::hasError($errors, 'description') !!}">
                                                            {!! Form::label('description', 'Description', ['class' => 'bold']) !!}
                                                            {!! Form::textarea('description[]', $value->description, array('class'=>'form-control tinymce_editor')) !!}
                                                            <span id="ov_desc_description" class="text-danger clear_error"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                

                                                <div class="text-right">
                                                    <button class="btn btn-danger btn-sm remove_btn" type="button"><i class="fa fa-trash-o"></i></button>
                                                </div>
                                            
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                
                                <div class="text-right">
                                    <button class="btn btn-default overview__cancel__btn"  type="button">Cancel</button>
                                    <button class="btn btn-primary btn_submit" type="submit"><span class="btnloader"><i class="fa fa-spinner fa-spin"></i></span> Submit</button>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <section class="second-section" id="banner">
        <div class="parallax ov_desc">
            <div class="container">
                <?php if(\Auth::guard('admin')->check()) {
                    // echo '<a class="clear_css toggle__overview__desc" href="javascript:;"><i class="fa fa-pencil fa-2x"></i></a>';
                }?>
                <div class="mkp__overview ul-list">
                    <?php echo !empty($overview->description) ? $overview->description : '' ?>
                </div>
            </div>
        </div>
        <div class="parallax-2">
            <div class="container">
                <?php if(\Auth::guard('admin')->check()) {
                    echo '<a class="clear_css toggle__overview__desc" href="javascript:;"><i class="fa fa-pencil fa-2x"></i></a>';
                }?>
                <div class="mkp__overview ul-list">
                    <?php echo !empty($overview->description) ? $overview->description : '' ?>
                </div>
            </div>
        </div>
        @if(1 == 0) 
            @if(\Auth::guard('admin')->check())
                <div class="parallax-3 ov_desc hide">
                    <div class="container">
                        <div class="update__ov_desc text-left mt-5 mb-4" >
                            <div class="row justify-content-center">
                                <div class="col-12">
            
                                    {!! Form::open(array('method' => 'post', 'route' => 'update.overview', 'class' => 'form', 'id' => 'ov_desc__form')) !!}

                                        <input type="hidden" name="update_id" value="{{ $eng_page_contents[5]->id }}">
                                        <input type="hidden" name="sub_title" value="{{ $eng_page_contents[5]->sub_title }}">
                                        <input type="hidden" name="sub_title_fr" value="{{ $eng_page_contents[5]->sub_title_fr }}">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'description') !!}">
                                                    {!! Form::label('description', 'Description', ['class' => 'bold']) !!}
                                                    {!! Form::textarea('description', $eng_page_contents[5]->description, array('class'=>'form-control tinymce_editor')) !!}
                                                    <span id="ov_desc_description" class="text-danger clear_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'description_fr') !!}">
                                                    {!! Form::label('description_fr', 'Description in french', ['class' => 'bold']) !!}
                                                    {!! Form::textarea('description_fr', $eng_page_contents[5]->description_fr, array('class'=>'form-control tinymce_editor')) !!}
                                                    <span id="ov_desc_description_fr" class="text-danger clear_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                        
                        
                                        <div class="text-right">
                                            <button class="btn btn-default ov_desc__cancel__btn"  type="button">Cancel</button>
                                            <button class="btn btn-primary btn_submit" type="submit"><span class="btnloader"><i class="fa fa-spinner fa-spin"></i></span> Submit</button>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>            
                </div>
            @endif
        @endif
    </section>

    <section class="third-section all-services-include">
        <div class="container text-center">
            <div class="update__service_title">
                <h1>
                    <?php echo !empty($service_title) ? $service_title->sub_title : '' ?> 
                    <?php if(\Auth::guard('admin')->check()) {
                        echo '<small><a class="clear_css toggle__service_title" href="javascript:;"><i class="fa fa-pencil"></i></a></small>';
                    }?>
                </h1>
                <p><?php echo !empty($service_title) ? strip_tags($service_title->description) : '' ?></p>
            </div>

            @if(\Auth::guard('admin')->check())
                <div class="update__service_title mb-5 text-left hide">
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-12">
                            {!! Form::open(array('method' => 'post', 'route' => 'update.overview', 'class' => 'form', 'id' => 'service_title__form')) !!}
                                
                                <input type="hidden" name="update_id" value="{{ $eng_page_contents[4]->id }}">
                                <div class="default__lang">
                                    <input type="hidden" name="language_id[]" value="44">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'sub_title') !!}">
                                                {!! Form::label('sub_title', 'Title', ['class' => 'bold']) !!}
                                                {!! Form::text('sub_title[]', $eng_page_contents[4]->sub_title, array('class'=>'form-control ')) !!}
                                                <span id="service_title_sub_title" class="text-danger clear_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'description') !!}">
                                                {!! Form::label('description', 'Description', ['class' => 'bold']) !!}
                                                {!! Form::text('description[]', strip_tags($eng_page_contents[4]->description), array('class'=>'form-control', 'id'=>'service_desc')) !!}
                                                <span id="service_title_description" class="text-danger clear_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-right mb-2">
                                    <button class="btn btn-warning add_more_btn" type="button"><span class="btnloader"><i class="fa fa-spinner fa-spin"></i></span> Add More</button>
                                    <input type="hidden" id="add_more_url" value="{{ route("add.more.service.title.lang") }}">
                                </div>

                                <div class="add_more_lang">
                                    <?php $lang_detail = \General::getPageDetail(5); ?>
                                    <?php $languages = General::getAllLanguage(); ?>
                                    @if(isset($lang_detail))
                                        @foreach ($lang_detail as $key => $value)
                                            <div class="add_more_block">
                                                <div class="form-group">
                                                    {!! Form::label('language_id', 'Other Language', ['class' => 'bold']) !!} 
                                                    {!! Form::select('language_id[]', ['' => 'Select Language']+$languages, $value->language_id, array('class'=>'form-control select2', 'required' =>'required', 'id'=>'language_id')) !!}                   
                                                    {!! APFrmErrHelp::showErrors($errors, 'language_id') !!}
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group {!! APFrmErrHelp::hasError($errors, 'sub_title') !!}">
                                                            {!! Form::label('title', 'Title', ['class' => 'bold']) !!}                    
                                                            {!! Form::text('sub_title[]', $value->sub_title, array('class'=>'form-control', 'id'=>'title', 'required' =>'required', 'placeholder'=>'Title')) !!}
                                                            {!! APFrmErrHelp::showErrors($errors, 'sub_title') !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group {!! APFrmErrHelp::hasError($errors, 'description') !!}">
                                                            {!! Form::label('description', 'Description', ['class' => 'bold']) !!}
                                                            {!! Form::text('description[]', $value->description, array('class'=>'form-control')) !!}
                                                            <span id="ov_desc_description" class="text-danger clear_error"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                

                                                <div class="text-right">
                                                    <button class="btn btn-danger btn-sm remove_btn" type="button"><i class="fa fa-trash-o"></i></button>
                                                </div>
                                            
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                
                                
                
                                <div class="text-right">
                                    <button class="btn btn-default service__cancel__btn"  type="button">Cancel</button>
                                    <button class="btn btn-primary btn_submit" type="submit"><span class="btnloader"><i class="fa fa-spinner fa-spin"></i></span> Submit</button>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            @endif

        </div>
        <div class="container text-center">
            <div class="row">
                @if(isset($service))
                    @foreach ($service as $key => $value)
                        <div class="col-md-4 service__detail" data-service="{{ $value->id }}">
                            <img src="{{ asset('/') }}home/images/services/{{$value->media}}" class="services-icons">
                            <p class="service-para">{{ $value->title }}</p>
                        </div>
                    @endforeach
                @endif
                
            </div>
        </div>
    </section>
    <section class="forth-section aboutus" id="about_section">
        <div class="container text-center">
            <div class="update__aboutus">
                <h1>
                    <?php echo !empty($about) ? $about->sub_title : '' ?>
                    <?php if(\Auth::guard('admin')->check()) {
                        echo '<small><a class="clear_css toggle__about" href="javascript:;"><i class="fa fa-pencil"></i></a></small>';
                    }?>
                </h1>
                <div class="aboutus-info"><?php echo !empty($about) ? $about->description : '' ?></div>
            </div>
            @if(\Auth::guard('admin')->check())

                <div class="update__aboutus text-left hide">
                    {!! Form::open(array('method' => 'post', 'route' => 'update.overview', 'class' => 'form', 'id' => 'about__form')) !!}
                        
                        <input type="hidden" name="update_id" value="{{ $eng_page_contents[3]->id }}">
                        <div class="default__lang">
                            <input type="hidden" name="language_id[]" value="44">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'sub_title') !!}">
                                        {!! Form::label('sub_title', 'Title', ['class' => 'bold']) !!}
                                        {!! Form::text('sub_title[]', $eng_page_contents[3]->sub_title, array('class'=>'form-control ')) !!}
                                        <span id="about_sub_title" class="text-danger clear_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'description') !!}">
                                        {!! Form::label('description', 'Description', ['class' => 'bold']) !!}
                                        {!! Form::textarea('description[]', $eng_page_contents[3]->description, array('class'=>'form-control tinymce_editor')) !!}
                                        <span id="about_description" class="text-danger clear_error"></span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="text-right mb-2">
                            <button class="btn btn-warning add_more_btn" type="button"><span class="btnloader"><i class="fa fa-spinner fa-spin"></i></span> Add More</button>
                            <input type="hidden" id="add_more_url" value="{{ route("add.more.overview.lang") }}">
                        </div>
                        <div class="add_more_lang">
                            <?php $lang_detail = \General::getPageDetail(4); ?>
                            <?php $languages = General::getAllLanguage(); ?>
                            @if(isset($lang_detail))
                                @foreach ($lang_detail as $key => $value)
                                    <div class="add_more_block">
                                        <div class="form-group">
                                            {!! Form::label('language_id', 'Other Language', ['class' => 'bold']) !!} 
                                            {!! Form::select('language_id[]', ['' => 'Select Language']+$languages, $value->language_id, array('class'=>'form-control select2', 'required' =>'required', 'id'=>'language_id')) !!}                   
                                            {!! APFrmErrHelp::showErrors($errors, 'language_id') !!}
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'sub_title') !!}">
                                                    {!! Form::label('title', 'Title', ['class' => 'bold']) !!}                    
                                                    {!! Form::text('sub_title[]', $value->sub_title, array('class'=>'form-control', 'id'=>'title', 'required' =>'required', 'placeholder'=>'Title')) !!}
                                                    {!! APFrmErrHelp::showErrors($errors, 'sub_title') !!}
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'description') !!}">
                                                    {!! Form::label('description', 'Description', ['class' => 'bold']) !!}
                                                    {!! Form::textarea('description[]', $value->description, array('class'=>'form-control tinymce_editor')) !!}
                                                    <span id="ov_desc_description" class="text-danger clear_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <div class="text-right">
                                            <button class="btn btn-danger btn-sm remove_btn" type="button"><i class="fa fa-trash-o"></i></button>
                                        </div>
                                    
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        
        
                        <div class="text-right">
                            <button class="btn btn-default about__cancel__btn"  type="button">Cancel</button>
                            <button class="btn btn-primary btn_submit" type="submit"><span class="btnloader"><i class="fa fa-spinner fa-spin"></i></span> Submit</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            @endif

            <div class="col-md-12 meet-team-and-latest-news">
                <div class="meetOur-team">
                    <a href="{{ route('meet.our.team') }}">@lang('messages.meetourteam')</a>
                </div>
                <div class="latestNews">
                    <a href="{{ route('news') }}">@lang('messages.latestnews')</a>
                </div>
            </div>
        </div>
    </section>
    <section class="fifth-section black-strip">
        <div class="container text-center">
        <h1>@lang('messages.gotaquestion')</h1>
        <p>@lang('messages.wearehere')</p>
        </div>
    </section>

    
    <!-- Service Info Modal Start -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="load__content">

                </div>
                @if(\Auth::guard('admin')->check())
                    <div class="update_service_detail text-left hide" id="hide_on_click">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body text-left">
                            {!! Form::open(array('method' => 'post', 'route' => 'update.service.detail', 'class' => 'form', 'id' => 'service_detail__form')) !!}
                                
                                <input type="hidden" name="update_id" id="update_id" >
                                <div class="default__lang">
                                    <input type="hidden" name="language_id[]" value="44">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {!! Form::label('title', 'Title', ['class' => 'bold']) !!}
                                                {!! Form::text('title[]', null, array('class'=>'form-control', 'id' => 'service_title')) !!}
                                                <span id="service_detail_title" class="text-danger clear_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group ">
                                                {!! Form::label('description', 'Description', ['class' => 'bold']) !!}
                                                {!! Form::textarea('description[]', null, array('class'=>'form-control', 'rows'=>3, 'id' => 'service_description')) !!}
                                                <span id="service_detail_description" class="text-danger clear_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="text-right mb-2">
                                    <button class="btn btn-warning add_more_btn" type="button"><span class="btnloader"><i class="fa fa-spinner fa-spin"></i></span> Add More</button>
                                    <input type="hidden" id="add_more_url" value="{{ route("add.more.service.lang") }}">
                                </div>

                                <div class="add_more_lang">
                                </div>
                                
                
                                <div class="text-right">
                                    <button class="btn btn-default service_detail__cancel__btn"  type="button">Cancel</button>
                                    <button class="btn btn-primary btn_submit service__detail__submit" type="submit"><span class="btnloader"><i class="fa fa-spinner fa-spin"></i></span> Submit</button>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
  <!-- Service Info Modal End-->

@endsection
@push('custom-script')
    <script>
        $(document).on('click', '.service__detail', function(e) {
            $('#hide_on_click').addClass('hide');
            var service_id = $(this).attr('data-service');
            $.ajax({
                url: '{{ route("get.service") }}',
                type: 'POST',
                data: {id: service_id, _token: '{{ csrf_token() }}'},
                beforeSend: function() {
                    $('#loader').show();
                },
                success: function(response) {
                    var res = JSON.parse(response);
                    $('.load__content').html(res.html);
                    console.log(res);
                    if($('#service_title').length > 0) {
                        $('#update_id').val(service_id);
                        $('#service_title').val(res.title);
                        // $('#service_title_fr').val(res.title_fr);
                        $('#service_description').val(res.description);
                        // $('#service_description_fr').val(res.description_fr);
                        $('#service_detail__form').find('.add_more_lang').html(res.service_detail);
                    }

                    $('#exampleModalCenter').modal("show");
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    alert("something went wrong! please try again.")
                    $('#loader').hide();
                },
                timeout: 8000
            })
            
        });
    </script>
@endpush

@if(\Auth::guard('admin')->check())

    @push('custom-script')
        <script src="{{ asset('/') }}home/js/homepage.js"></script>
        <script src="{{ asset('/') }}backend/js/tinymce/jquery.tinymce.min.js" type="text/javascript"></script>        
        <script src="{{ asset('/') }}backend/js/tinymce/tinymce.min.js" type="text/javascript"></script>

        <script>
            tinymce.init({
                selector: '.tinymce_editor',
                height: 150,
                forced_root_block: '',
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table contextmenu paste code'
                ],
                toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image'
            });
        </script>

    @endpush
@endif

