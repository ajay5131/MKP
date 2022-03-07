<!-- APFrmerrHelp is a custom helper name as AdminFormErrorHelper -->
{!! APFrmErrHelp::showErrorsNotice($errors) !!}

@include('flash::message')

<div class="form-body">
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'title') !!}">
        {!! Form::label('Title', 'Title', ['class' => 'bold']) !!}                    
        {!! Form::text('title', (empty($detail->title) ? null : $detail->title), array('class'=>'form-control', 'id'=>'Title', 'placeholder'=>'Title')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'title') !!}                                       
    </div>
    
    <div class="form-actions">
        {!! Form::button((empty($detail) ? 'Save' : 'Update') .' <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
    </div>
</div>
