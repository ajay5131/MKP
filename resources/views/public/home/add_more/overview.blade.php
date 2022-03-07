<div class="add_more_block">
    <div class="form-group">
        <?php $languages = General::getAllLanguage(); ?>
        {!! Form::label('language_id', 'Other Language', ['class' => 'bold']) !!} 
        {!! Form::select('language_id[]', ['' => 'Select Language']+$languages, null, array('class'=>'form-control select2', 'required' =>'required', 'id'=>'language_id')) !!}                   
        {!! APFrmErrHelp::showErrors($errors, 'language_id') !!}
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'sub_title') !!}">
                {!! Form::label('sub_title', 'Title', ['class' => 'bold']) !!}                    
                {!! Form::text('sub_title[]', null, array('class'=>'form-control', 'id'=>'sub_title', 'placeholder'=>'Title')) !!}
                {!! APFrmErrHelp::showErrors($errors, 'sub_title') !!}                                       
            </div>
        </div>
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'description') !!}">
        {!! Form::label('description', 'Description', ['class' => 'bold']) !!}
        {!! Form::textarea('description[]', null, array('class'=>'form-control tinymce_editor')) !!}
        <span id="ov_desc_description" class="text-danger clear_error"></span>
    </div>


    <div class="text-right">
        <button class="btn btn-danger btn-sm remove_btn" type="button"><i class="fa fa-trash-o"></i></button>
    </div>
</div>