<!-- APFrmerrHelp is a custom helper name as AdminFormErrorHelper -->
{!! APFrmErrHelp::showErrorsNotice($errors) !!}

@include('flash::message')

<div class="form-body">
    
    
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'tag_id') !!}" id="tag_id_div">
                {!! Form::label('tag_id', 'Tag User', ['class' => 'bold']) !!}                    
                {!! Form::select('tag_id', ['' => 'Select Tag User'], old('tag_id', (isset($detail))? $detail->tag_id:null), array('class'=>'form-control', 'id'=>'tag_id')) !!}
                {!! APFrmErrHelp::showErrors($errors, 'tag_id') !!}                                       
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'team_type') !!}" id="team_type_div">
                {!! Form::label('team_type', 'Team Type', ['class' => 'bold']) !!}                    
                {!! Form::select('team_type', ['' => 'Select Team Type']+$team_type, old('team_type', (isset($detail))? $detail->team_type:null), array('class'=>'form-control', 'id'=>'team_type')) !!}
                {!! APFrmErrHelp::showErrors($errors, 'team_type') !!}                                       
            </div>
        </div>
    </div>
    
    <div class="default__lang">

        <div class="form-group {!! APFrmErrHelp::hasError($errors, 'language_id') !!}" id="language_id_div">
            {!! Form::label('language_id', 'Default Language', ['class' => 'bold']) !!}                    
            <input type="text" disabled readonly value="English" class="form-control">
            <input type="hidden" value="44" name="language_id[]">                                       
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'full_name') !!}">
                    {!! Form::label('full_name', 'Full Name', ['class' => 'bold']) !!}                    
                    {!! Form::text('full_name[]', (empty($detail->full_name) ? null : $detail->full_name), array('class'=>'form-control', 'id'=>'full_name', 'placeholder'=>'Full Name')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'full_name') !!}                                       
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'designation') !!}">
                    {!! Form::label('designation', 'Designation', ['class' => 'bold']) !!}                    
                    {!! Form::text('designation[]', (empty($detail->designation) ? null : $detail->designation), array('class'=>'form-control', 'id'=>'designation', 'placeholder'=>'Designation')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'designation') !!}                                       
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'description') !!}">
                    {!! Form::label('description', 'Description', ['class' => 'bold']) !!}
                    {!! Form::textarea('description[]', (empty($detail->description) ? null : $detail->description), array('class'=>'form-control tinymce_editor', 'rows' => 5, 'id'=>'description', 'placeholder'=>'Description')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'description') !!}
                </div>
            </div>
        </div>

        <div class="text-right mb-2">
            <button class="btn btn-warning add_more_btn" type="button">Add More</button>
        </div>

    </div>

    <div class="add_more_lang">
        @if(isset($team_detail))
            <?php $languages = General::getAllLanguage(); ?>
            @foreach ($team_detail as $key => $value)
                <div class="add_more_block">
                    <div class="form-group">
                        {!! Form::label('language_id', 'Other Language', ['class' => 'bold']) !!} 
                        {!! Form::select('language_id[]', ['' => 'Select Language']+$languages, $value->language_id, array('class'=>'form-control select2', 'required' =>'required', 'id'=>'language_id')) !!}                   
                        {!! APFrmErrHelp::showErrors($errors, 'language_id') !!}
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'full_name') !!}">
                                {!! Form::label('full_name', 'Full Name', ['class' => 'bold']) !!}                    
                                {!! Form::text('full_name[]', $value->full_name, array('class'=>'form-control', 'id'=>'full_name', 'placeholder'=>'Full Name')) !!}
                                {!! APFrmErrHelp::showErrors($errors, 'full_name') !!}                                       
                            </div>
                        </div>
            
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'designation') !!}">
                                {!! Form::label('designation', 'Designation', ['class' => 'bold']) !!}                    
                                {!! Form::text('designation[]', $value->designation, array('class'=>'form-control', 'id'=>'designation', 'placeholder'=>'Designation')) !!}
                                {!! APFrmErrHelp::showErrors($errors, 'designation') !!}                                       
                            </div>
                        </div>
                    </div>
            
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'description') !!}">
                                {!! Form::label('description', 'Description', ['class' => 'bold']) !!}
                                {!! Form::textarea('description[]', $value->description, array('class'=>'form-control tinymce_editor', 'rows' => 5, 'id'=>'description', 'placeholder'=>'Description')) !!}
                                {!! APFrmErrHelp::showErrors($errors, 'description') !!}
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <button class="btn btn-danger remove_btn" type="button">Remove</button>
                    </div>
                </div>
            @endforeach
        @endif        
    </div>

    
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'media') !!}">
        {!! Form::label('media', 'Profile Image', ['class' => 'bold']) !!}

        {!! Form::file('media', array('class'=>'mb-2', 'accept' => 'image/jpg,image/jpeg,image/png', 'id'=>'media', 'placeholder'=>'Media')) !!}
        
        @if(isset($detail))
            <img src="{{ asset('uploads/our_team/'.$detail->media) }}" width="150" alt="">
        @endif

        {!! APFrmErrHelp::showErrors($errors, 'media') !!}
    </div>


    <div class="form-actions">
        {!! Form::button((empty($detail) ? 'Save' : 'Update') .' <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
    </div>
</div>


<input type="hidden" id="add_more_url" value="{{ route("add.more.team.lang") }}">