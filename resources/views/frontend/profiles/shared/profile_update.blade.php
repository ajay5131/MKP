<?php 
$show_main = [1];
$show_agent = [2, 3, 4, 5];
$show_prefession = [2, 3, 4, 5, 6, 7];
$show_type = [8, 9];
$show_gender = [1, 2, 3, 4, 5, 6, 7, 10];
$show_pet_friendly = [8, 9];
$show_film_location = [8, 9];
$show_no_of_people = [8, 9];
?>

{!! Form::open(array('method' => 'post', 'route' => 'update.profile', 'class' => 'form', 'id' => 'profile_edit_form', 'files'=>false)) !!}

    <input type="hidden" name="profile_id" value="{{$profile_id}}">
    <input type="hidden" name="user" value="{{$user_profile_id}}">

    <div class="d-flex my-3 help-block">
        <div class="col-md-3 text-left">
            <label>@lang('messages.full_name')</label>
        </div>
        <div class="col-md-9">
            {!! Form::text('full_name', $profile_info->full_name, array('class'=>'form-control custom-h', 'autocomplete' => 'off', 'id'=>'fullname',  'data-validate' =>'required,alphaspace,max:20', 'placeholder'=>'Full Name')) !!}
        </div>
    
    </div>

    @if(in_array($profile_id, $show_gender))
        <div class="d-flex my-3">
            <div class="col-md-3 text-left help-block">
                <label>@lang('messages.gender')</label>
            </div>
            <div class="col-md-9 text-left">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" {{ $profile_info->gender == "Male" ? 'checked' : ''}} value="Male" type="radio" name="gender" id="inlineRadio1">
                    <label class="form-check-label" for="inlineRadio1">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" {{ $profile_info->gender == "Female" ? 'checked' : ''}} value="Female" type="radio" name="gender" id="inlineRadio2">
                    <label class="form-check-label" for="inlineRadio2">Female</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" {{ $profile_info->gender == "Non-Binary" ? 'checked' : ''}} value="Non-Binary" type="radio" name="gender" id="inlineRadio3">
                    <label class="form-check-label" for="inlineRadio3">Non-Binary</label>
                </div>
            </div>
        </div>
    @endif

    @if(in_array($profile_id, $show_type))
        <div class="d-flex my-3 help-block">
            <div class="col-md-3 text-left">
                <label>@lang('messages.type')</label>
            </div>
            <div class="col-md-9">
                <?php $type = explode(',', \Config::get('global.profile_'.$profile_id.'_type')); ?>
                {!! Form::select('profession[]', ['' => 'Select Type'] + $type, (isset($profile_info->profession) ? explode(',', $profile_info->profession) : null), array('class'=>'form-control select2')) !!}
            </div>
        </div>
    @endif

    @if(in_array($profile_id, $show_no_of_people))
        <div class="d-flex my-3 help-block">
            <div class="col-md-3 text-left">
                <label>@lang('messages.no_of_people')</label>
            </div>

            <div class="col-md-9">
                <input type="text" class="js-range-slider" value=""
                    data-skin="round"
                    data-type="double"
                    data-min="0"
                    data-max="1000"
                    data-grid="false"
                    data-from="{{ !empty($profile_info->no_of_people) ? explode('-', $profile_info->no_of_people)[0] : 0}}"
                    data-to="{{ !empty($profile_info->no_of_people) ? explode('-', $profile_info->no_of_people)[1] : 1000}}"
                />

                <input type="hidden" name="no_of_people_from" maxlength="4" value="{{ !empty($profile_info->no_of_people) ? explode('-', $profile_info->no_of_people)[0] : 0}}" class="from"/>
                <input type="hidden" name="no_of_people_to" maxlength="4" value="{{ !empty($profile_info->no_of_people) ? explode('-', $profile_info->no_of_people)[1] : 1000}}" class="to"/>
            </div>
        </div>
    @endif

    @if(in_array($profile_id, $show_pet_friendly))
        <div class="d-flex my-3">
            <div class="col-md-3 text-left help-block">
                <label>@lang('messages.pet_friendly')</label>
            </div>
            <div class="col-md-9 text-left">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" {{ $profile_info->pet_friendly == "1" ? 'checked' : ''}} value="1" type="radio" name="pet_friendly" id="pet_friendly_yes">
                    <label class="form-check-label" for="pet_friendly_yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" {{ $profile_info->pet_friendly == "0" ? 'checked' : ''}} value="0" type="radio" name="pet_friendly" id="pet_friendly_no">
                    <label class="form-check-label" for="pet_friendly_no">No</label>
                </div>
            </div>
        </div>
    @endif

    @if(in_array($profile_id, $show_film_location))
        <div class="d-flex my-3">
            <div class="col-md-3 text-left help-block">
                <label>@lang('messages.film_location')</label>
            </div>
            <div class="col-md-9 text-left">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" {{ $profile_info->film_location == "1" ? 'checked' : ''}} value="1" type="radio" name="film_location" id="film_location_yes">
                    <label class="form-check-label" for="film_location_yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" {{ $profile_info->film_location == "0" ? 'checked' : ''}} value="0" type="radio" name="film_location" id="film_location_no">
                    <label class="form-check-label" for="film_location_no">No</label>
                </div>
            </div>
        </div>
    @endif
    

    @if(in_array($profile_id, $show_prefession))
        <div class="d-flex my-3 help-block">
            <div class="col-md-3 text-left">
                <label>@lang('messages.profession')</label>
            </div>
            <div class="col-md-9">
                <?php $profession = \Config::get('global.profile_'.$profile_id.'_profession'); ?>
                {!! Form::select('profession[]', $profession, (isset($profile_info->profession) ? explode(',', $profile_info->profession) : null), array('class'=>'form-control select2', 'multiple' => 'multiple')) !!}
            </div>
        </div>
    @endif

    @if(in_array($profile_id, $show_agent))
        <div class="d-flex my-3">
            <div class="col-md-3 text-left help-block">
                <label>@lang('messages.agent')</label>
            </div>
            <div class="col-md-9 text-left">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" {{ $profile_info->is_agent == 1 ? 'checked' : ''}} value="1" type="radio" name="is_agent" id="is_agent_yes">
                    <label class="form-check-label" for="is_agent_yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" {{ $profile_info->is_agent == 0 ? 'checked' : ''}} value="0" type="radio" name="is_agent" id="is_agent_no">
                    <label class="form-check-label" for="is_agent_no">No</label>
                </div>
            </div>
        </div>
    @endif

    @if(in_array($profile_id, $show_main))

        <div class="d-flex my-3 help-block">
            <div class="col-md-3 text-left">
                <label>@lang('messages.personality')</label>
            </div>
            <div class="col-md-9">
                <?php $personality = \Config::get('global.personalities'); ?>
                {!! Form::select('personality', ['' => 'Select'] + $personality, (isset($profile_info->personality) ? $profile_info->personality : null), array('class'=>'form-control')) !!}
                
            </div>
        </div>
        <div class="d-flex my-3 help-block">
            <div class="col-md-3 text-left">
                <label>@lang('messages.profession')</label>
            </div>
            <div class="col-md-9">
                {!! Form::text('profession', $profile_info->profession, array('class'=>'form-control custom-h', 'autocomplete' => 'off', 'id'=>'profession',  'data-validate' =>'max:30', 'placeholder'=>'Profession')) !!}
            </div>
        </div>

    @endif

    <div class="d-flex my-3 help-block">
        <div class="col-md-3 text-left">
            <label>@lang('messages.date_of_birth')</label>
        </div>
        <div class="col-md-9">
            <input type="text" name="dob" value="{{ $profile_info->dob }}" id="dobPicker" class="form-control custom-h" autocomplete="off" placeholder="Date of Birth"  data-validate="required,maxage:13">
        </div>
    </div>

    <div class="d-flex my-3 help-block">
        <div class="col-md-3 text-left">
            <label>@lang('messages.country')</label>
        </div>
        <div class="col-md-9">
            <?php $country = \General::getAllCountry(); ?>
            {!! Form::select('country_id',['' => 'Select']+$country, $profile_info->country_id, array('class'=>'form-control select2', 'data-validate' =>'required', 'id' => 'country_id')) !!}
        </div>
    </div>

    <div class="d-flex my-3 help-block">
        <div class="col-md-3 text-left">
            <label>@lang('messages.state')</label>
        </div>
        <div class="col-md-9">
            {!! Form::select('state_id',['' => 'Select'], null, array('class'=>'form-control select2', 'id' => 'state_id', 'data-validate' =>'required')) !!}
        </div>
    </div>

    <div class="d-flex my-3 help-block">
        <div class="col-md-3 text-left">
            <label>@lang('messages.city')</label>
        </div>
        <div class="col-md-9">
            {!! Form::select('city_id',['' => 'Select'], null, array('class'=>'form-control select2', 'id' => 'city_id', 'data-validate' =>'required')) !!}
        </div>
    </div>

    <div class="d-flex my-3 help-block">
        <div class="col-md-3 text-left">
            <label>@lang('messages.description')</label>
        </div>
        <div class="col-md-9">
            {!! Form::textarea('description', $profile_info->description, array('class'=>'form-control custom-h', 'maxlength' => 255, 'autocomplete' => 'off', 'id'=>'display_left_char', 'rows'=>'2',  'data-validate' =>'max:200', 'placeholder'=>'Description')) !!}
            <div><small><span id="char_length">Characters {{strlen($profile_info->description)}}/200</span></small></div>
        </div>
    </div>
    <div class="d-flex my-3 help-block">
        <div class="col-md-3 text-left">
            <label>@lang('messages.website')</label>
        </div>
        <div class="col-md-9">
            {!! Form::url('website', $profile_info->website, array('class'=>'form-control custom-h', 'autocomplete' => 'off', 'data-validate' =>'url', 'placeholder'=>'Website')) !!}
        </div>
    </div>

    <div class="d-flex pt-5">
        <div class="col-md-12 text-center">
            <button type="submit" onclick="return validateRegister($('#profile_edit_form'));" class="btn bg-btn-color btn-color-w btn-lg btn-block">@lang('messages.save')</button>
        </div>
    </div>

{!! Form::close() !!}


@if(in_array($profile_id, $show_no_of_people))
    <script src="{{ asset('/') }}home/js/range-slider.js" type="text/javascript"></script>
@endif

<script>
    $(document).ready(function(){
        $('.select2').select2();
        $('#dobPicker').flatpickr({
            dateFormat:"Y-m-d"
        });

        $(document).on('keyup', '#display_left_char', function(e) {
            if($(this).val() != "") {
                $('#char_length').html('Characters ' + $(this).val().length + '/200' );
            } else {
                $('#char_length').html('Characters 0/200' );
            }
        });

        var country = '{{ $profile_info->country_id }}';
        var state = '{{ $profile_info->state_id }}';
        var city = '{{ $profile_info->city_id }}';
        
        if(country) {
            getState(country);
        }
        if(state) {
            getCity(state);
        }

        var is_state_change_trigger = false;

        $(document).on('change', '#country_id', function(e) {
            e.preventDefault();
            state='';
            emptySelect($('#city_id'));
            getState($(this).val());
        });

        $(document).on('change', '#state_id', function(e) {
            e.preventDefault();
            if(is_state_change_trigger == false) {
                city='';
            }
            is_state_change_trigger = false;
            getCity($(this).val());
        });

        function getState(country_id) {
            if (country_id != ''){
                $.get("{{route('get.state')}}", {country_id: country_id})
                .done(function (response) {
                    $('#state_id').html(response);
                    if(state) {
                        is_state_change_trigger = true;
                        $('#state_id').val(state).trigger('change');
                    }
                });
            }
        }
        function getCity(state_id) {
            if (state_id != ''){
                $.get("{{route('get.city')}}", {state_id: state_id})
                .done(function (response) {
                    $('#city_id').html(response);
                    if(city) {
                        $('#city_id').val(city).trigger('change');
                    }
                });
            }
        }
        
        function emptySelect(element) {
            element.empty();
        }
    });
</script>

