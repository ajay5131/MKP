<!-- APFrmerrHelp is a custom helper name as AdminFormErrorHelper -->
{!! APFrmErrHelp::showErrorsNotice($errors) !!}

@include('flash::message')

<div class="form-body">

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'full_name') !!}">
        {!! Form::label('full_name', 'Full Name', ['class' => 'bold']) !!}                    
        {!! Form::text('full_name', (empty($detail->full_name) ? null : $detail->full_name), array('class'=>'form-control', 'id'=>'full_name', 'placeholder'=>'Full Name')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'full_name') !!}                                       
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'email') !!}">
        {!! Form::label('email', 'Email', ['class' => 'bold']) !!}                    
        {!! Form::text('email', (empty($detail->email) ? null : $detail->email), array('class'=>'form-control', 'id'=>'email', 'placeholder'=>'Email')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'email') !!}                                       
    </div>
    
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'email') !!}">
        {!! Form::label('password', 'Password', ['class' => 'bold']) !!}                    
        {!! Form::password('password', array('id'=>'password', 'class'=>'form-control','placeholder'=> (empty($detail->email) ? 'Password' : 'Password (keep blank if don\'t want to update it.)') )) !!}
        {!! APFrmErrHelp::showErrors($errors, 'password') !!}                                       
    </div>

    <div class="form-actions">
        {!! Form::button((empty($detail) ? 'Save' : 'Update') .' <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
    </div>
</div>
