<!-- APFrmerrHelp is a custom helper name as AdminFormErrorHelper -->
{!! APFrmErrHelp::showErrorsNotice($errors) !!}

@include('flash::message')


<div class="form-body">
    <div class="default__lang">

        <div class="form-group">
            {!! Form::label('language_id', 'Default Language', ['class' => 'bold']) !!}                    
            <input type="text" disabled readonly value="English" class="form-control">
            <input type="hidden" value="44" name="language_id[]">
        </div>
    
        <div class="form-group {!! APFrmErrHelp::hasError($errors, 'lang_translate_label_id') !!}" id="lang_translate_label_id_div">
            {!! Form::label('lang_translate_label_id', 'Label', ['class' => 'bold']) !!}   
            <span id="generate_state">                 
                {!! Form::select('lang_translate_label_id', ['' => 'Select Label']+$labels, old('lang_translate_label_id', (isset($detail))? $detail->lang_translate_label_id:null), array('class'=>'form-control select2', 'id'=>'lang_translate_label_id')) !!}
            </span>
            {!! APFrmErrHelp::showErrors($errors, 'lang_translate_label_id') !!}                                       
        </div>
        <div class="form-group {!! APFrmErrHelp::hasError($errors, 'value') !!}">
            {!! Form::label('title', 'Title', ['class' => 'bold']) !!}                    
            {!! Form::text('value[]', (empty($detail->value) ? null : $detail->value), array('class'=>'form-control', 'id'=>'value', 'placeholder'=>'Title')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'value') !!}                                       
        </div>

        <div class="text-right mb-2">
            <button class="btn btn-warning add_more_btn" type="button">Add More</button>
        </div>
    </div>

    <div class="add_more_lang">
        @if(isset($lang_detail))
            <?php $languages = General::getAllLanguage(); ?>
            @foreach ($lang_detail as $key => $value)
                <div class="add_more_block">
                    <div class="form-group">
                        {!! Form::label('language_id', 'Other Language', ['class' => 'bold']) !!} 
                        {!! Form::select('language_id[]', ['' => 'Select Language']+$languages, $value->language_id, array('class'=>'form-control select2', 'required' =>'required', 'id'=>'language_id')) !!}                   
                        {!! APFrmErrHelp::showErrors($errors, 'language_id') !!}
                    </div>
                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'value') !!}">
                                {!! Form::label('value', 'Title', ['class' => 'bold']) !!}                    
                                {!! Form::text('value[]', $value->value, array('class'=>'form-control', 'id'=>'value', 'required' =>'required', 'placeholder'=>'Title')) !!}
                                {!! APFrmErrHelp::showErrors($errors, 'value') !!}
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

    <div class="form-actions">
        {!! Form::button((empty($detail) ? 'Save' : 'Update') .' <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
    </div>
</div>

<input type="hidden" id="add_more_url" value="{{ route("add.more.lang.translate.lang") }}">
