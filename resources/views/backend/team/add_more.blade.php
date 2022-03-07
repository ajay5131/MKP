<div class="add_more_block">
    <div class="form-group">
        <?php $languages = General::getAllLanguage(); ?>
        {!! Form::label('language_id', 'Other Language', ['class' => 'bold']) !!} 
        {!! Form::select('language_id[]', ['' => 'Select Language']+$languages, null, array('class'=>'form-control select2', 'id'=>'language_id')) !!}                   
        {!! APFrmErrHelp::showErrors($errors, 'language_id') !!}
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'full_name') !!}">
                {!! Form::label('full_name', 'Full Name', ['class' => 'bold']) !!}                    
                {!! Form::text('full_name[]', null, array('class'=>'form-control', 'id'=>'full_name', 'placeholder'=>'Full Name')) !!}
                {!! APFrmErrHelp::showErrors($errors, 'full_name') !!}                                       
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'designation') !!}">
                {!! Form::label('designation', 'Designation', ['class' => 'bold']) !!}                    
                {!! Form::text('designation[]', null, array('class'=>'form-control', 'id'=>'designation', 'placeholder'=>'Designation')) !!}
                {!! APFrmErrHelp::showErrors($errors, 'designation') !!}                                       
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'description') !!}">
                {!! Form::label('description', 'Description', ['class' => 'bold']) !!}
                {!! Form::textarea('description[]', null, array('class'=>'form-control tinymce_editor', 'rows' => 5, 'id'=>'description', 'placeholder'=>'Description')) !!}
                {!! APFrmErrHelp::showErrors($errors, 'description') !!}
            </div>
        </div>
    </div>

    <div class="text-right">
        <button class="btn btn-danger remove_btn" type="button">Remove</button>
    </div>
</div>