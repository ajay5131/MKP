<!-- APFrmerrHelp is a custom helper name as AdminFormErrorHelper -->
{!! APFrmErrHelp::showErrorsNotice($errors) !!}

@include('flash::message')

<div class="form-body">
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'title') !!}">
        {!! Form::label('country', 'Country', ['class' => 'bold']) !!}                    
        {!! Form::text('title', (empty($detail->title) ? null : $detail->title), array('class'=>'form-control', 'id'=>'country', 'placeholder'=>'Country')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'title') !!}                                       
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'title_fr') !!}">
        {!! Form::label('country_fr', 'Country in french', ['class' => 'bold']) !!}                    
        {!! Form::text('title_fr', (empty($detail->title_fr) ? null : $detail->title_fr), array('class'=>'form-control', 'id'=>'country_fr', 'placeholder'=>'Country in french')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'title_fr') !!}                                       
    </div>
    <div class="form-actions">
        {!! Form::button((empty($detail) ? 'Save' : 'Update') .' <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
    </div>
</div>
