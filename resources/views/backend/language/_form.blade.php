<!-- APFrmerrHelp is a custom helper name as AdminFormErrorHelper -->
{!! APFrmErrHelp::showErrorsNotice($errors) !!}

@include('flash::message')


<div class="form-body">

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'code') !!}">
        {!! Form::label('code', 'Code', ['class' => 'bold']) !!}                    
        {!! Form::text('code', (empty($detail->code) ? null : $detail->code), array('class'=>'form-control', 'id'=>'code', 'placeholder'=>'Code')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'code') !!}                                       
    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'language') !!}">
        {!! Form::label('language', 'Language', ['class' => 'bold']) !!}                    
        {!! Form::text('language', (empty($detail->language) ? null : $detail->language), array('class'=>'form-control', 'id'=>'language', 'placeholder'=>'Language')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'language') !!}                                       
    </div>

    <div class="form-group d-flex status__block {!! APFrmErrHelp::hasError($errors, 'direction') !!}">
        {!! Form::label('direction', 'Direction', ['class' => 'bold']) !!}
        <div class="radio-list">
            <label class="radio-inline">
                <input id="not_active" name="direction" type="radio" value="0" {{ (isset($detail) ? ($detail->direction == 0 ? 'checked' : '') : '' )}}>
                LTR (Left to Right) </label>
            <label class="radio-inline">
                <input id="active" name="direction" type="radio" value="1" {{ (isset($detail) ? ($detail->direction == 1 ? 'checked' : '') : '' )}}>
                RTL (Right to Left) </label>
        </div>			
        {!! APFrmErrHelp::showErrors($errors, 'direction') !!}
    </div>

    <div class="form-group d-flex status__block {!! APFrmErrHelp::hasError($errors, 'status') !!}">
        {!! Form::label('status', 'Is Active?', ['class' => 'bold']) !!}
        <div class="radio-list">
            <label class="radio-inline">
                <input id="active" name="status" type="radio" value="1" {{ (isset($detail) ? ($detail->status == 1 ? 'checked' : '') : '' )}}>
                Active </label>
            <label class="radio-inline">
                <input id="not_active" name="status" type="radio" value="0" {{ (isset($detail) ? ($detail->status == 0 ? 'checked' : '') : '' )}}>
                In-Active </label>
        </div>			
        {!! APFrmErrHelp::showErrors($errors, 'status') !!}
    </div>
    
    <div class="form-actions">
        {!! Form::button((empty($detail) ? 'Save' : 'Update') .' <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
    </div>
</div>
