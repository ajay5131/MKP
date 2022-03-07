<!-- APFrmerrHelp is a custom helper name as AdminFormErrorHelper -->
{!! APFrmErrHelp::showErrorsNotice($errors) !!}

@include('flash::message')

<div class="form-body">
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'country_id') !!}" id="country_id_div">
        {!! Form::label('country_id', 'Country', ['class' => 'bold']) !!}                    
        {!! Form::select('country_id', ['' => 'Select Country']+$countries, old('country_id', (isset($detail))? $detail->country_id:null), array('class'=>'form-control select2', 'id'=>'country_id')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'country_id') !!}                                       
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'title') !!}">
        {!! Form::label('state', 'State', ['class' => 'bold']) !!}                    
        {!! Form::text('title', (empty($detail->title) ? null : $detail->title), array('class'=>'form-control', 'id'=>'state', 'placeholder'=>'State')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'title') !!}                                       
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'title_fr') !!}">
        {!! Form::label('state_fr', 'State in french', ['class' => 'bold']) !!}                    
        {!! Form::text('title_fr', (empty($detail->title_fr) ? null : $detail->title_fr), array('class'=>'form-control', 'id'=>'state_fr', 'placeholder'=>'State in french')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'title_fr') !!}                                       
    </div>
    <div class="form-actions">
        {!! Form::button((empty($detail) ? 'Save' : 'Update') .' <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
    </div>
</div>
