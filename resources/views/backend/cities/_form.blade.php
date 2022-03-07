<!-- APFrmerrHelp is a custom helper name as AdminFormErrorHelper -->
{!! APFrmErrHelp::showErrorsNotice($errors) !!}

@include('flash::message')


<div class="form-body">
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'country_id') !!}" id="country_id_div">
        {!! Form::label('country_id', 'Country', ['class' => 'bold']) !!}                    
        {!! Form::select('country_id', ['' => 'Select Country']+$countries, old('country_id', (isset($detail))? $detail->getCountryId() : null), array('class'=>'form-control select2', 'id'=>'country_id')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'country_id') !!}                                       
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'state_id') !!}" id="state_id_div">
        {!! Form::label('state_id', 'State', ['class' => 'bold']) !!}   
        <span id="generate_state">                 
            {!! Form::select('state_id', ['' => 'Select State'], old('state_id', (isset($detail))? $detail->state_id:null), array('class'=>'form-control select2', 'id'=>'state_id')) !!}
        </span>
        {!! APFrmErrHelp::showErrors($errors, 'state_id') !!}                                       
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'title') !!}">
        {!! Form::label('city', 'City', ['class' => 'bold']) !!}                    
        {!! Form::text('title', (empty($detail->title) ? null : $detail->title), array('class'=>'form-control', 'id'=>'city', 'placeholder'=>'City')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'title') !!}                                       
    </div>
    {{-- <div class="form-group {!! APFrmErrHelp::hasError($errors, 'title_fr') !!}">
        {!! Form::label('state_fr', 'State in french', ['class' => 'bold']) !!}                    
        {!! Form::text('title_fr', (empty($detail->title_fr) ? null : $detail->title_fr), array('class'=>'form-control', 'id'=>'state_fr', 'placeholder'=>'State in french')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'title_fr') !!}                                       
    </div> --}}
    <div class="form-actions">
        {!! Form::button((empty($detail) ? 'Save' : 'Update') .' <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
    </div>
</div>


@push('custom-script')
    <script>
        $(document).on('change', '#country_id', function(e) {
            listStates(0)
        });

        $(document).ready(function(e) {
            listStates(<?php echo old('state_id', (isset($detail))? $detail->state_id:0); ?>);
        });

        function listStates(state_id) {
            var country_id = $('#country_id').val();
            if (country_id != ''){
                $.post("{{ route('get.states.by.country') }}", {country_id: country_id, state_id: state_id, _method: 'POST', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    $('#generate_state').html(response);
                    // Initiate select2
                    setTimeout(() => {
                        $('.select2').select2();
                    }, 200);
                });
            }
        }
        
    </script>
@endpush