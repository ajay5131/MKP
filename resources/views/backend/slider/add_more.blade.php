<div class="add_more_block">
    <div class="form-group">
        <?php $languages = General::getAllLanguage(); ?>
        {!! Form::label('language_id', 'Other Language', ['class' => 'bold']) !!} 
        {!! Form::select('language_id[]', ['' => 'Select Language']+$languages, null, array('class'=>'form-control select2', 'id'=>'language_id')) !!}                   
        {!! APFrmErrHelp::showErrors($errors, 'language_id') !!}
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'title') !!}">
                {!! Form::label('title', 'Title', ['class' => 'bold']) !!}                    
                {!! Form::text('title[]', null, array('class'=>'form-control', 'id'=>'title', 'placeholder'=>'Title')) !!}
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
    <div class="text-right">
        <button class="btn btn-danger remove_btn" type="button">Remove</button>
    </div>
</div>