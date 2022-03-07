@extends('frontend.layouts.layout')

@section('content')

    <section class="setting-sec">
        <div class="container">
            {!! Form::open(array('method' => 'post', 'route' => 'setting', 'class' => 'form', 'id' => 'setting_form', 'files'=>true)) !!}
            
                {!! APFrmErrHelp::showErrorsNotice($errors) !!}
            
                <div class="tab">
                    <button type="button" class="tablinks" onclick="openTab(event, 'genral-setting')" id="defaultOpen"><i
                            class="fa fa-cogs" aria-hidden="true"></i> General Settings</button>
                    <button type="button" class="tablinks" onclick="openTab(event, 'profile-and-verification')">
                        <i class="fa fa-users" aria-hidden="true"></i> Profiles & Verification</button>
                    <button type="button" class="tablinks" onclick="openTab(event, 'matching-interests')">
                        <i class="fa fa-tasks" aria-hidden="true"></i> Matching Interests</button>
                    <button type="button" class="tablinks" onclick="openTab(event, 'security')">
                        <i class="fa fa-key" aria-hidden="true"></i> Security</button>
                    <button type="button" class="tablinks" onclick="openTab(event, 'privacy')"><i class="fa fa-lock"
                            aria-hidden="true"></i> Privacy</button>
                    <button type="button" class="tablinks" onclick="openTab(event, 'delete-account')"><i class="fa fa-trash-o"
                            aria-hidden="true"></i>
                        Delete Account</button>
                </div>
            
                <div id="genral-setting" class="tabcontent ">
                    <div class="container">
                        <div class="row py-3">
                            <div class="col-md-12">
                                <h3 class="tab-title">General Settings</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="Fullname">@lang('messages.full_name') <span class="mandatory-star">*</span></label>
                                {!! Form::text('full_name', $profile->full_name, array('class'=>'form-control custom-h', 'autocomplete' => 'off', 'id'=>'fullname',  'data-validate' =>'required,alphaspace', 'placeholder'=>'Full Name')) !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label>Gender :</label>
                                <div class="col-md-12 gender-btn">

                                    <div>

                                        <input class="form-check-input" type="radio" name="gender" value="Male"
                                            id="flexRadioDefault1" {{ ($profile->gender == 'Male' ? 'checked' : '' ) }}>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Male
                                        </label>
                                    </div>
                                    <div>
                                        <input class="form-check-input" type="radio" name="gender" value="Female"
                                            id="flexRadioDefault2" {{ ($profile->gender == 'Female' ? 'checked' : '' ) }}>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Female
                                        </label>
                                    </div>
                                    <div>
                                        <input class="form-check-input" type="radio" name="gender" value="Non-Binary"
                                            id="flexRadioDefault3" {{ ($profile->gender == 'Non-Binary' ? 'checked' : '' ) }}>
                                        <label class="form-check-label" for="flexRadioDefault3">
                                            Non-Binary
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Date of Birth :<span class="mandatory-star">*</span></label>
                                {{-- <div class="input-group date" data-provide="datepicker"> --}}
                                    <input type="text" class="form-control" id="dobDatepicker" name="dob" data-validate="required,maxage:13" value="{{ $profile->dob }}">
                                    {{-- <div class="input-group-addon">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-md-6">
                                <label for="inputCountry" class="w-100">@lang('messages.country') <span class="mandatory-star">*</span></label>
                                <?php $country = \General::getAllCountry(); ?>
                                {!! Form::select('country_id',['' => 'Select']+$country, $profile->country_id, array('class'=>'form-control select2', 'data-validate' =>'required', 'id' => 'country_id')) !!}
                            </div>
                            <div class="col-md-6">
                                <label for="inputState">@lang('messages.state') <span class="mandatory-star">*</span></label>
                                {!! Form::select('state_id',['' => 'Select'], null, array('class'=>'form-control select2', 'id' => 'state_id', 'data-validate' =>'required')) !!}
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-md-6">
                                <label for="inputCity">@lang('messages.city') <span class="mandatory-star">*</span></label>
                                {!! Form::select('city_id',['' => 'Select'], null, array('class'=>'form-control select2', 'id' => 'city_id', 'data-validate' =>'required')) !!}
                            </div>
                            <div class="col-md-6">
                                <label for="enter-username">@lang('messages.handle_name') <span class="mandatory-star">*</span></label>
                                {!! Form::text('handle_name', $profile->handle_name, array('class'=>'form-control custom-h', 'autocomplete' => 'off', 'id'=>'handle_name',  'data-validate' =>'required,alphaunderscorenumeric', 'placeholder'=>'Handlename')) !!}
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-md-6">
                                <label for="inputState" class="mb-0">@lang('messages.your_pin') <span class="mandatory-star">*</span> <span class="note-txt"><small>@lang('messages.pin_instruction')</small></span></label>
                                
                                {!! Form::text('pin', $profile->pin, array('maxlength' => 6, 'class'=>'form-control custom-h', 'autocomplete' => 'off', 'id'=>'pin',  'data-validate' =>'required', 'placeholder'=>'Pin')) !!}
                                
                            </div>
                            <div class="col-md-6">


                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-md-12 text-center">
                                <button class="button savebtn" type="submit" name="save_btn" value="general_setting" onclick="if(validateRegister($('#genral-setting')) == false){return false;}">@lang('messages.save_profile')</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div id="profile-and-verification" class="tabcontent ">

                    <div class="container">
                        <div class="additional_profile">
                            <div class="row py-3">
                                <div class="col-md-12">
                                    <h3 class="tab-title">Additional Profiles</h3>
                                </div>
                            </div>
                            <?php $additional_profile = \General::getAllProfile(); ?>
                            @foreach ($additional_profile as $key => $value)

                                <div class="row py-1 v-align-center">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="profile_{{$key}}" name="profile_id[]" value="{{ $key }}" {{ !empty($profiles[$key]) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="profile_{{$key}}">{{ $value }}</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        {!! Form::text('handlename['.$key.']', (!empty($profiles[$key]) ? $profiles[$key] : ''), array('class'=>'form-control custom-h handlename_unique_validation', 'autocomplete' => 'off', 'id'=>'handlename__'.$key,  'data-validate' =>'requiredifcheckbox:profile_'.$key.',alphaunderscorenumeric', 'placeholder'=>'Handlename')) !!}
                                        {{-- <input type="text" name="profile_{{$key}}" class="form-control"> --}}
                                    </div>
                                </div>

                            @endforeach

                            <div class="row py-1 my-3">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck9" name="dissociate" value="1" {{ ($profile->dissociate == 1) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="exampleCheck9">Dissociate my Main/Marketplace from my
                                            additional profiles</label>
                                    </div>
                                </div>

                            </div>

                            <div class="row my-5 py-4">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="button saveProfile additional_profile_btn" name="save_btn" value="additional_profile" onclick="if(validateRegister($('.additional_profile')) == false){return false;}">Save Profile</button>
                                </div>

                            </div>
                        </div>

                        <div class="verification__id">

                            <div class="row py-3">
                                <div class="col-md-12">
                                    <h3 class="tab-title">Verification :</h3>
                                </div>
                            </div>
                            <div class="row py-3">
                                <div class="col-md-12 text-center">
                                    <p>Upload an ID card document or passport</p>
                                    <p class="red-text-col-para">Your documents will be kept strictly confidential and anonymous
                                        and will only be needed for the verification process.</p>
                                    <p class="red-text-col-para1">We want to avoid fake accounts and scams as much as possible.</p>
                                    <div class="text-left">
                                        {!! Form::file('pic', array('class'=>'form-control', 'accept' => 'image/jpg,image/jpeg,image/png', 'data-validate' => 'required', 'id'=>'verification_picture')) !!}
                                    </div>
                                    <button type="submit" class="button saveProfile my-5" name="save_btn" value="verification_id" onclick="if(validateRegister($('.verification__id')) == false){return false;}">Save Profile</button>
                                </div>
                            </div>

                        </div>



                    </div>
                </div>

                <div id="matching-interests" class="tabcontent ">
                    <div class="row py-3">
                        <div class="col-md-12 text-center">
                            <h3 class="tab-title pt-1">@lang('messages.what_are_your_interests')</h3>
                            <p class="py-1">@lang('messages.we_use_this_to_match_you_with_right_people_and_projects')</p>
                        </div>
                    </div>
                    <?php $interest = \General::getAllInterest(); ?>
                    <?php $interestImages = \General::getAllInterestImages(); ?>

                    <div class="row py-3">
                        <div class="col-md-5">
                            <label class="form-check-label">@lang('messages.select_interest') <span class="mandatory-star">*</span></label>
                                        
                            {!! Form::select('interest_id[]', $interest, explode(',', $profile->interest_id), array('class'=>'form-control select2 int_select', 'multiple' => 'multiple', 'data-validate' =>'required', 'data-attribute' => 'Interest')) !!}

                        </div>
                        <div class="col-md-7">
                            <div class="image-grid matchingintrests">
                                @foreach (explode(',', $profile->interest_id) as $key => $value)
                                    <div class="text-center match_int_{{$value}}">
                                        <div class="setting-grid-img"> 
                                            <img src="{{ asset('/') }}home/images/icons/{{ $interestImages[$value] }}" class="interest-img-grid">
                                        </div>
                                        <p class="matching_int_text">{{ $interest[$value] }}</p>
                                    </div>
                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                    <div class="row py-3">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="button saveProfile" name="save_btn" value="match_interest" onclick="if(validateRegister($('#matching-interests')) == false){return false;}">Save Profile</button>
                        </div>
                    </div>
                </div>
                
                <div id="security" class="tabcontent ">
                    <div class="row py-3">
                        <div class="col-md-12">
                            <h3 class="tab-title">Security</h3>
                            <p>Passwords must be at least 6 characters in length.</p>
                        </div>
                    </div>

                    <div class="row py-1">
                        <div class="col-md-12">
                            <label>Email:</label>
                            <input type="text" disabled value="{{ $profile->email }}" class="form-control">
                        </div>
                    </div>
                    {{-- <div class="row pt-2">
                        <div class="col-md-12">
                            <label>Handlename:</label>
                            <input type="text" name="" class="form-control" placeholder="Handlename">
                        </div>
                    </div> --}}

                    <div class="row pt-2">
                        <div class="col-md-12">
                            <label>@lang('messages.old_password')</label>
                            {!! Form::password('old_password', array('class'=>'form-control custom-h', 'autocomplete' => 'off', 'id'=>'old_password',  'data-validate' =>'required', 'placeholder'=>'Enter old password')) !!}
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-md-12">
                            <label for="enter-password">@lang('messages.new_password') </label>
                            {!! Form::password('password', array('class'=>'form-control custom-h', 'autocomplete' => 'off', 'id'=>'password',  'data-validate' =>'required,min:6,max:8', 'placeholder'=>'Enter new password')) !!}
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-md-12">
                            <label for="enter-password-confirm">@lang('messages.retype_new_password') </label>
                            {!! Form::password('confirm_password', array('class'=>'form-control custom-h', 'autocomplete' => 'off', 'id'=>'confirm_password',  'data-validate' =>'required,match:password', 'placeholder'=>'Please Enter the new password again')) !!}
                        </div>
                    </div>

                    <div class="row pt-2 ">
                        <div class="col-md-12 text-center py-3">
                            <button type="submit" class="button saveProfile" name="save_btn" value="security_tab" onclick="if(validateRegister($('#security')) == false){return false;}">Save Password</button>
                        </div>
                    </div>
                </div>



                <div id="privacy" class="tabcontent ">
                    <div class="row py-3">
                        <div class="col-md-10">
                            <h3 class="tab-title">Privacy Options</h3>
                            <p>Public Main Profile</p>
                        </div>
                        <div class="col-md-2">
                            <label class="switch">
                                <input type="checkbox" name="is_private" value="1" onchange="$('.privacy_submit').trigger('click')" {{ ($profile->is_private == 1) ? 'checked' : '' }}>
                                <span class="slider round"></span>
                            </label>
                            <button type="submit" class="hide privacy_submit" name="save_btn" value="private_profile"></button>
                        </div>
                    </div>
                    <div class="row py-3">
                        <div class="col-md-12">
                            <p><strong>When your public profile is switched to 'no' (i.e. Private):</strong></p>

                            <ul class="ul-list-in-privacy-option">
                                <li>No one can follow you or see your profile activity except your Key People.</li>
                                <li>Your headshot and name will still display if you message another member or like/comment on
                                    their profile.</li>
                            </ul>
                        </div>
                    </div>
                </div>

            {!! Form::close() !!}


            <div id="delete-account" class="tabcontent">
                <div class="row py-3">
                    <div class="col-md-12">
                        <h3 class="tab-title pt-1">Delete Account</h3>
                        <p class="py-1">Permanently remove your account using the button below. Warning, this
                            action is permanent.</p>
                        <button type="button" class="delete-account-btn">Delete Account</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('custom-script')
        <script>
            $(".int_select").on("select2:selecting", function(e) { 
                var str = e.params.args.data.text;
                var id = e.params.args.data.id;
                str = str.trim();
                textstr = str;
                removed_space = str.replace(/\s+/g, '');
                str = str.replace(/\s+/g, '+');
                var html = `<div class="text-center match_int_`+id+`">
                    <div class="setting-grid-img"> 
                        <img src="{{ asset('/') }}home/images/icons/`+str+`.png" class="interest-img-grid">
                    </div>
                    <p class="matching_int_text">`+textstr+`</p>
                </div>`;
                $(".matchingintrests").append(html); 
            });
            $(".int_select").on("select2:unselecting", function(e) { 
                var id = e.params.args.data.id;
                $('.match_int_'+id).remove();
            });

            var state,city;
            $(document).ready(function() {

                var country = '{{ $profile->country_id }}';
                state = '{{ $profile->state_id }}';
                city = '{{ $profile->city_id }}';
    
                if(country) {
                    $('#country_id').trigger('change');
                }

            });

            $(document).on('change', '#country_id', function(e) {
                e.preventDefault();
                getState($(this).val());
            });

            $(document).on('change', '#state_id', function(e) {
                e.preventDefault();
                getCity($(this).val());
            });

            function getState(country_id) {
                if (country_id != ''){
                    $.get("{{route('get.state')}}", {country_id: country_id})
                    .done(function (response) {
                        $('#state_id').html(response);
                        if(state) {
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
            function openTab(evt, tabName) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                    if(!tabcontent[i].classList.contains('ignore')) {
                        tabcontent[i].className += " ignore";
                    }
                }
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
               document.getElementById(tabName).style.display = "block";
               $('#' + tabName).removeClass('ignore');
               
                evt.currentTarget.className += " active";
            }
            document.getElementById("defaultOpen").click();

        </script>
    @endpush
@endsection