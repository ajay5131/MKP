<!-- APFrmerrHelp is a custom helper name as AdminFormErrorHelper -->
{!! APFrmErrHelp::showErrorsNotice($errors) !!}

@include('flash::message')

<div class="form-body">
    
    <div class="default__lang">

        <div class="form-group">
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

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'media') !!}">
        {!! Form::label('media', 'Media', ['class' => 'bold']) !!}

        {!! Form::file('media', array('class'=>'mb-2', 'accept' => 'image/jpg,image/jpeg,image/png', 'id'=>'media', 'placeholder'=>'Media')) !!}
        
        @if(isset($detail))
            <img src="{{ asset('uploads/news/'.$detail->media) }}" width="150" alt="">
        @endif

        {!! APFrmErrHelp::showErrors($errors, 'media') !!}
    </div>


    <div class="form-actions">
        {!! Form::button((empty($detail) ? 'Save' : 'Update') .' <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
    </div>
</div>

<input type="hidden" id="add_more_url" value="{{ route("add.more.news.lang") }}">