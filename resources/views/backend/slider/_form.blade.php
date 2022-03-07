<!-- APFrmerrHelp is a custom helper name as AdminFormErrorHelper -->
{!! APFrmErrHelp::showErrorsNotice($errors) !!}

@include('flash::message')

<div class="form-body">
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'slider_type') !!}" id="slider_type_div">
        {!! Form::label('slider_type', 'Slider Category', ['class' => 'bold']) !!}                    
        {!! Form::select('slider_type', ['' => 'Select Slider Category']+$slider_type, old('slider_type', (isset($detail))? $detail->slider_type:'All'), array('class'=>'form-control', 'id'=>'slider_type')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'slider_type') !!}                                       
    </div>
    <div class="default__lang">

        <div class="form-group {!! APFrmErrHelp::hasError($errors, 'language_id') !!}" id="language_id_div">
            {!! Form::label('language_id', 'Default Language', ['class' => 'bold']) !!}                    
            <input type="text" disabled readonly value="English" class="form-control">
            <input type="hidden" value="44" name="language_id[]">                                       
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'title') !!}">
                    {!! Form::label('title', 'Title', ['class' => 'bold']) !!}                    
                    {!! Form::text('title[]', (empty($detail->title) ? null : $detail->title), array('class'=>'form-control', 'id'=>'title', 'placeholder'=>'Title')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'title') !!}                                       
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'description') !!}">
                    {!! Form::label('description', 'Description', ['class' => 'bold']) !!}
                    {!! Form::textarea('description[]', null, array('class'=>'form-control', 'rows' => 3, 'id'=>'description', 'placeholder'=>'Description')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'description') !!}
                </div>
            </div>
        </div>

        <div class="text-right mb-2">
            <button class="btn btn-warning add_more_btn" type="button">Add More</button>
        </div>

    </div>

    <div class="add_more_lang">
        @if(isset($slider_detail))
            <?php $languages = General::getAllLanguage(); ?>
            @foreach ($slider_detail as $key => $value)
                <div class="add_more_block">
                    <div class="form-group">
                        {!! Form::label('language_id', 'Other Language', ['class' => 'bold']) !!} 
                        {!! Form::select('language_id[]', ['' => 'Select Language']+$languages, $value->language_id, array('class'=>'form-control select2', 'required' =>'required', 'id'=>'language_id')) !!}                   
                        {!! APFrmErrHelp::showErrors($errors, 'language_id') !!}
                    </div>
                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'title') !!}">
                                {!! Form::label('title', 'Title', ['class' => 'bold']) !!}                    
                                {!! Form::text('title[]', $value->title, array('class'=>'form-control', 'id'=>'title', 'required' =>'required', 'placeholder'=>'Title')) !!}
                                {!! APFrmErrHelp::showErrors($errors, 'title') !!}
                            </div>
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'description') !!}">
                                {!! Form::label('description', 'Description', ['class' => 'bold']) !!}
                                {!! Form::textarea('description[]', $value->description, array('class'=>'form-control', 'rows' => 3, 'required' =>'required', 'id'=>'description', 'placeholder'=>'Description')) !!}
                                {!! APFrmErrHelp::showErrors($errors, 'description') !!}
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-danger remove_btn" type="button">Remove</button>
                    </div>
                </div>
            @endforeach
        @endif        
    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'show_more_btn_link') !!}">
        {!! Form::label('show_more_btn_link', 'See More Button Link', ['class' => 'bold']) !!}
        {!! Form::text('show_more_btn_link', null, array('class'=>'form-control', 'id'=>'show_more_btn_link', 'placeholder'=>'See More Button Link')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'show_more_btn_link') !!}
    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'media') !!}">
        {!! Form::label('media', 'Media', ['class' => 'bold']) !!}

        {!! Form::file('media', array('class'=>'mb-2', 'data-max-size' => '4096', 'accept' => 'image/jpg,image/jpeg,image/png,video/mp4', 'id'=>'media', 'placeholder'=>'Media')) !!}
        <div class="mb-2"><span><small class="text-danger">Media should be jpg, jpeg, png, or mp4. Max media size is 4 MB.</small></span></div>
        @if(isset($detail))
            @if($detail->media_type == 'mp4') 
                <video width="320" height="240"  controls>
                    <source src="{{ asset('/') .'uploads/slider/'.$detail->media}}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            @else
                <img src="{{ asset('/') . 'uploads/slider/' . $detail->media }}" width="150" alt="">
            @endif
        @endif

        {!! APFrmErrHelp::showErrors($errors, 'media') !!}
    </div>

    <div class="form-group d-flex status__block {!! APFrmErrHelp::hasError($errors, 'is_active') !!}">
        {!! Form::label('is_active', 'Is Active?', ['class' => 'bold']) !!}
        <div class="radio-list">
            <label class="radio-inline">
                <input id="active" name="is_active" type="radio" value="1" {{ (isset($detail) ? ($detail->is_active == 1 ? 'checked' : '') : 'checked' )}}>
                Active </label>
            <label class="radio-inline">
                <input id="not_active" name="is_active" type="radio" value="0" {{ (isset($detail) ? ($detail->is_active == 0 ? 'checked' : '') : '' )}}>
                In-Active </label>
        </div>			
        {!! APFrmErrHelp::showErrors($errors, 'is_active') !!}
    </div>
    	

    <div class="form-actions">
        {!! Form::button((empty($detail) ? 'Save' : 'Update') .' <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'id' =>'submit_btn', 'type'=>'submit')) !!}
    </div>
</div>

<input type="hidden" id="add_more_url" value="{{ route('add.more.slider.lang') }}">

@push('custom-script')
    <script>
        $('#media').change(function(e) {
            var fileInput = $(this);
            var maxSize = fileInput.attr('data-max-size');
            if(fileInput.get(0).files.length){
                var fileSize = fileInput.get(0).files[0].size; // in bytes
                
                if((fileSize/1024)>maxSize){
                    alert('media should not more than ' + (maxSize/1024) + ' MB');
                    $('#submit_btn').attr('disabled', 'disabled');
                    return false;
                } else {
                    $('#submit_btn').removeAttr('disabled');
                }
            }
        })
    </script>
@endpush