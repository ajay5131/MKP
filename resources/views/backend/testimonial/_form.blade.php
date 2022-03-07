<!-- APFrmerrHelp is a custom helper name as AdminFormErrorHelper -->
{!! APFrmErrHelp::showErrorsNotice($errors) !!}

@include('flash::message')

<div class="form-body">

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'tag_id') !!}" id="tag_id_div">
        {!! Form::label('tag_id', 'Tag User', ['class' => 'bold']) !!}                    
        {!! Form::select('tag_id', ['' => 'Select Tag User'], old('tag_id', (isset($detail))? $detail->tag_id:null), array('class'=>'form-control', 'id'=>'tag_id')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'tag_id') !!}                                       
    </div>

    <div class="default__lang">

        <div class="form-group {!! APFrmErrHelp::hasError($errors, 'language_id') !!}" id="language_id_div">
            {!! Form::label('language_id', 'Default Language', ['class' => 'bold']) !!}                    
            <input type="text" disabled readonly value="English" class="form-control">
            <input type="hidden" value="44" name="language_id[]">                                       
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'full_name') !!}">
                    {!! Form::label('full_name', 'Full Name', ['class' => 'bold']) !!}                    
                    {!! Form::text('full_name[]', (empty($detail->full_name) ? null : $detail->full_name), array('class'=>'form-control', 'id'=>'full_name', 'placeholder'=>'Full Name')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'full_name') !!}                                       
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'profession') !!}">
                    {!! Form::label('profession', 'Company and Designation', ['class' => 'bold']) !!}                    
                    {!! Form::text('profession[]', (empty($detail->profession) ? null : $detail->profession), array('class'=>'form-control', 'id'=>'profession', 'placeholder'=>'Company and Designation')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'profession') !!}                                       
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'testimonial') !!}">
                    {!! Form::label('testimonial', 'Testimonial', ['class' => 'bold']) !!}
                    {!! Form::textarea('testimonial[]', (empty($detail->testimonial) ? null : $detail->testimonial), array('class'=>'form-control tinymce_editor', 'rows' => 5, 'id'=>'testimonial', 'placeholder'=>'Testimonial')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'testimonial') !!}
                </div>
            </div>
        </div>

        <div class="text-right mb-2">
            <button class="btn btn-warning add_more_btn" type="button">Add More</button>
        </div>

    </div>

    <div class="add_more_lang">
        @if(isset($lang_detail))
            <?php $languages = General::getAllLanguage(); ?>
            @foreach ($lang_detail as $key => $value)
                <div class="add_more_block">
                    <div class="form-group">
                        {!! Form::label('language_id', 'Other Language', ['class' => 'bold']) !!} 
                        {!! Form::select('language_id[]', ['' => 'Select Language']+$languages, $value->language_id, array('class'=>'form-control select2', 'required' =>'required', 'id'=>'language_id')) !!}                   
                        {!! APFrmErrHelp::showErrors($errors, 'language_id') !!}
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'full_name') !!}">
                                {!! Form::label('full_name', 'Full Name', ['class' => 'bold']) !!}                    
                                {!! Form::text('full_name[]', $value->full_name, array('class'=>'form-control', 'id'=>'full_name', 'placeholder'=>'Full Name')) !!}
                                {!! APFrmErrHelp::showErrors($errors, 'full_name') !!}                                       
                            </div>
                        </div>
            
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'profession') !!}">
                                {!! Form::label('profession', 'Company and Designation', ['class' => 'bold']) !!}                    
                                {!! Form::text('profession[]', (empty($value->profession) ? null : $value->profession), array('class'=>'form-control', 'id'=>'profession', 'placeholder'=>'Company and Designation')) !!}
                                {!! APFrmErrHelp::showErrors($errors, 'profession') !!}                                       
                            </div>
                        </div>
                    </div>
            
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'testimonial') !!}">
                                {!! Form::label('testimonial', 'Testimonial', ['class' => 'bold']) !!}
                                {!! Form::textarea('testimonial[]', (empty($value->testimonial) ? null : $value->testimonial), array('class'=>'form-control tinymce_editor', 'rows' => 5, 'id'=>'testimonial', 'placeholder'=>'Testimonial')) !!}
                                {!! APFrmErrHelp::showErrors($errors, 'testimonial') !!}
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

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'media') !!}">
        {!! Form::label('media', 'Profile Image', ['class' => 'bold']) !!}

        {!! Form::file('media', array('class'=>'mb-2', 'accept' => 'image/jpg,image/jpeg,image/png', 'id'=>'media', 'placeholder'=>'Media')) !!}
        
        @if(isset($detail))
            <img src="{{ asset('uploads/testimonails/'.$detail->media) }}" width="150" alt="">
        @endif

        {!! APFrmErrHelp::showErrors($errors, 'media') !!}
    </div>


    <div class="form-actions">
        {!! Form::button((empty($detail) ? 'Save' : 'Update') .' <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
    </div>
</div>


<input type="hidden" id="add_more_url" value="{{ route("add.more.testimonial.lang") }}">