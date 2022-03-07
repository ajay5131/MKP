<div class="add_more_block">
    <div class="form-group">
        <?php $languages = General::getAllLanguage(); ?>
        {!! Form::label('language_id', 'Other Language', ['class' => 'bold']) !!} 
        {!! Form::select('language_id[]', ['' => 'Select Language']+$languages, null, array('class'=>'form-control select2', 'required' =>'required', 'id'=>'language_id')) !!}                   
        {!! APFrmErrHelp::showErrors($errors, 'language_id') !!}
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'question') !!}">
                {!! Form::label('question', 'Question', ['class' => 'bold']) !!}                    
                {!! Form::text('question[]', null, array('class'=>'form-control', 'id'=>'question', 'placeholder'=>'Question')) !!}
                {!! APFrmErrHelp::showErrors($errors, 'question') !!}                                       
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'answer') !!}">
                {!! Form::label('answer', 'Answer', ['class' => 'bold']) !!}
                {!! Form::textarea('answer[]', null, array('class'=>'form-control tinymce_editor', 'rows' => 3, 'id'=>'answer', 'placeholder'=>'Answer')) !!}
                {!! APFrmErrHelp::showErrors($errors, 'answer') !!}
            </div>
        </div>
    </div>

    <div class="text-right">
        <button class="btn btn-danger remove_btn" type="button">Remove</button>
    </div>
</div>