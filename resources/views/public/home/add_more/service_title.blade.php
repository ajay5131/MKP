<div class="add_more_block">
    <div class="form-group">
        <?php $languages = General::getAllLanguage(); ?>
        {!! Form::label('language_id', 'Other Language', ['class' => 'bold']) !!} 
        {!! Form::select('language_id[]', ['' => 'Select Language']+$languages, null, array('class'=>'form-control select2', 'required' =>'required', 'id'=>'language_id')) !!}                   
        {!! APFrmErrHelp::showErrors($errors, 'language_id') !!}
    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'sub_title') !!}">
        {!! Form::label('sub_title', 'Title', ['class' => 'bold']) !!}
        {!! Form::text('sub_title[]', null, array('class'=>'form-control ')) !!}
        <span id="service_title_sub_title" class="text-danger clear_error"></span>
    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'description') !!}">
        {!! Form::label('description', 'Description', ['class' => 'bold']) !!}
        {!! Form::text('description[]', null, array('class'=>'form-control')) !!}
        <span id="service_title_description" class="text-danger clear_error"></span>
    </div>

    <div class="text-right">
        <button class="btn btn-danger btn-sm remove_btn" type="button"><i class="fa fa-trash-o"></i></button>
    </div>
</div>