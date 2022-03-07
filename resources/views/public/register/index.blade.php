@extends('public.layouts.layout')

@section('content')
    @push('custom-style')
        <style>
            body{
                overflow-x:hidden;
            }
            #uploadprofileimgModal {
                z-index: 99999999;
            }
            .error_block span{
                display: block
            }
        </style>
    @endpush


    <section class="contact-section">
        <div class="container">
            <div class="row">
                
                {!! Form::open(array('method' => 'post', 'route' => 'register', 'class' => 'form', 'id' => 'msform', 'files'=>true)) !!}
                    <!-- APFrmerrHelp is a custom helper name as AdminFormErrorHelper -->
                    {!! APFrmErrHelp::showErrorsNotice($errors) !!}

                    <!-- progressbar -->
                    <ul id="progressbar">
                        <li class="active">@lang('messages.step') 1</li>
                        <li>@lang('messages.step') 2</li>
                        <li>@lang('messages.step') 3</li>
                        <li>@lang('messages.step') 4</li>
                        <li>@lang('messages.step') 5</li>
                        <li>@lang('messages.step') 6</li>


                    </ul>
                    <!-- fieldsets -->
                    <fieldset class="ignore">
                        <h5 class="fs-title">@lang('messages.who_are_you')</h5>
                        <p class="fs-subtitle">@lang('messages.choose_option_a')<br>
                            @lang('messages.unsure_contact_us')</p>

                        <div class="row">
                            <input type="hidden" name="who_are_you">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 selected_option" data-box="A">
                                <div class="register-grid-grey-box">
                                    <span class="option">A</span>
                                    <i class="fa fa-male man-icon" aria-hidden="true"></i>
                                    <p class="para-register">@lang('messages.option_a')</p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 selected_option" data-box="B">
                                <div class="register-grid-grey-box">
                                    <span class="option">B</span>
                                    <i class="fa fa-suitcase suitcase-icon" aria-hidden="true"></i>
                                    <p class="para-register">@lang('messages.option_b')</p>

                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 selected_option" data-box="C">
                                <div class="register-grid-grey-box">
                                    <span class="option">C</span>
                                    <i class="fa fa-building-o building-icon" aria-hidden="true"></i>
                                    <p class="para-register">@lang('messages.option_c')</p>

                                </div>
                            </div>
                        </div>
                        <input type="button" name="next" disabled="disabled" class="nxt1 next action-button" value="@lang('messages.next')" />
                    </fieldset>

                    <fieldset class="ignore">
                        <h5 class="fs-title">@lang('messages.choose_your_secondary_profile')</h5>
                        <p class="fs-subtitle">@lang('messages.link_as_many_additional_profiles_to_your_main_profile')</p>
                        
                        <?php $profile = \General::getAllProfile(); ?>
                        
                        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-4 align-center-box">
                            <input type="checkbox" name="profile_id[]" value="1" class="hide" checked id="profile_1">
                            
                            @foreach ($profile as $key => $value)
                                
                                <div class="checkbox-content">
                                    <div>
                                        <input type="checkbox" name="profile_id[]" value="{{ $key }}" class="form-check-input check-input" id="profile_{{$key}}">
                                    </div>
                                    <div>
                                        <label class="form-check-label label-align" for="profile_{{$key}}">{{ $value }}
                                        </label>
                                        <span>
                                            <?php 
                                                $allProfession = \General::getAllProfileProfessionByProfile($key); 
                                                $profession = implode(' | ', $allProfession);
                                            ?>
                                            <a href="#" class="fa fa-info-circle tooltip-tool" data-html="true" data-toggle="tooltip"
                                                title="{{$profession}}"></a>
                                        </span>
                                        
                                    </div>
                                </div>

                            @endforeach

                            <input type="checkbox" name="profile_id[]" value="10" class="hide" checked id="profile_10">

                        
                        </div>

                        <input type="button" name="previous" class="previous action-button" value="@lang('messages.previous')" />
                        <input type="button" name="next" class="next action-button" value="@lang('messages.next')" />
                    </fieldset>

                    <fieldset class="ignore">
                        <h5 class="fs-title">@lang('messages.what_are_your_interests')</h5>
                        <p class="fs-subtitle">@lang('messages.we_use_this_to_match_you_with_right_people_and_projects')</p>
                        <div class="row">
                            <?php $interest = \General::getAllInterest(); ?>
                            <div class="col-sm-12 col-md-6 col-lg-6 select-interest">
                                <div class="interest__selection">
                                    <label class="form-check-label">@lang('messages.select_interest') <span class="mandatory-star">*</span></label>
                                    
                                    {!! Form::select('interest_id[]', $interest, null, array('class'=>'form-control select2 int_select', 'multiple' => 'multiple', 'data-required' =>'true', 'data-attribute' => 'Interest')) !!}
                                    
                                </div>
                            </div>
                            
                            <div class="col-sm-12 col-md-6 col-lg-6 text-left">
                                <div class="interest__images">
                                    <div class="image-grid matchingintrests">                                        
                                    </div>                                
                                </div>
                            </div>
                        </div>

                        <input type="button" name="previous" class="previous action-button" value="@lang('messages.previous')" />
                        <input type="button" name="next" disabled class="next action-button nxt_interest" value="@lang('messages.next')" />
                    </fieldset>

                    <fieldset class="ignore">

                        <h5 class="fs-title">@lang('messages.user_details')</h5>
                        <p class="fs-subtitle">@lang('messages.please_enter_your_information')</p>
                        <div class="container text-left" id="user_details">
                            <div class="form-group">
                                <label for="Fullname">@lang('messages.full_name') <span class="mandatory-star">*</span></label>
                                {!! Form::text('full_name', old('full_name'), array('class'=>'form-control custom-h', 'autocomplete' => 'off', 'id'=>'fullname',  'data-validate' =>'required,alphaspace', 'placeholder'=>'Full Name')) !!}
                            </div>


                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="gender">@lang('messages.gender') <span class="mandatory-star">*</span></label>
                                    <div class="gender-area">
                                        <input type="radio" name="gender" class="gender" id="male" value="Male"
                                            checked="checked">
                                        <label for="male">Male</label>
                                        <input type="radio" name="gender" class="gender" id="female" value="Female">
                                        <label for="female">Female</label>
                                        <input type="radio" name="gender" class="gender" id="non-binary"
                                            value="Non-Binary">
                                        <label for="non-binary">Non-Binary</label>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <label for="dobDatepicker">@lang('messages.date_of_birth') <span class="mandatory-star">*</span></label>
                                    <input type="text" name="dob" id="dobDatepicker" class="custom-h"
                                        placeholder="Date of Birth"  data-validate="required,maxage:13">
                                </div>
                            </div>

                            <div class="form-row">
                                
                                <div class="form-group col-md-4">
                                    <label for="inputCountry" class="w-100">@lang('messages.country') <span class="mandatory-star">*</span></label>
                                    <?php $country = \General::getAllCountry(); ?>
                                    {!! Form::select('country_id',['' => 'Select']+$country, null, array('class'=>'form-control select2', 'data-validate' =>'required', 'id' => 'country_id')) !!}
                                    
                                </div>


                                <div class="form-group col-md-4">
                                    <label for="inputState">@lang('messages.state') <span class="mandatory-star">*</span></label>
                                    {!! Form::select('state_id',['' => 'Select'], null, array('class'=>'form-control select2', 'id' => 'state_id', 'data-validate' =>'required')) !!}
                                </div>



                                <div class="form-group col-md-4">
                                    <label for="inputCity">@lang('messages.city') <span class="mandatory-star">*</span></label>
                                    {!! Form::select('city_id',['' => 'Select'], null, array('class'=>'form-control select2', 'id' => 'city_id', 'data-validate' =>'required')) !!}
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputHearAbout">@lang('messages.how_did_you_hear_about_us') <span class="mandatory-star">*</span></label>
                                    <select class="form-control custom-h" name="how_did_you_hear_about" id="how_did_you_hear_about"  data-validate="required" >
                                        <option value="">Select</option>
                                        <option value="0">Someone told me about it</option>
                                        <option value="Email">Email</option>
                                        <option value="Facebook">Facebook</option>
                                        <option value="Instagram">Instagram</option>
                                        <option value="LinkedIn">LinkedIn</option>
                                        <option value="Google">Google</option>
                                        <option value="Job board">Job board</option>
                                        <option value="Flyer">Flyer</option>
                                        <option value="Advert">Advert</option>
                                        <option value="Twitter">Twitter</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-4 hear_from_other hide" >
                                    <label for="inputHearAbout">@lang('messages.other') <span class="mandatory-star">*</span></label>
                                    {!! Form::text('how_did_hear_about_us_other', old('how_did_hear_about_us_other'), array('class'=>'form-control custom-h', 'autocomplete' => 'off', 'id'=>'how_did_hear_about_us_other', 'data-validate' =>'required', 'placeholder'=>'Other')) !!}
                                </div>
                                <div class="col-lg-4 sponsor_name_div hide">
                                    <label for="inputHearAbout">@lang('messages.sponsor_name') <span class="mandatory-star">*</span></label>
                                    {!! Form::select('sponsor_id',['' => 'Select'], null, array('class'=>'form-control select2', 'id' => 'sponsor_id', 'data-validate' =>'required')) !!}
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="inputState">@lang('messages.your_pin') <span class="mandatory-star">*</span></label>
                                    <?php 
                                        $pin = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
                                    ?>
                                    <input type="text" class="form-control custom-h" readonly disabled id="inputAddress2" placeholder="{{$pin}}">
                                    <input type="hidden" name="pin" value="{{$pin}}">
                                </div>

                            </div>

                        </div>

                        <input type="button" name="previous" class="previous action-button" value="@lang('messages.previous')" />
                        <input type="button" name="next" class="next action-button" value="@lang('messages.next')" />
                    </fieldset>



                    <fieldset class="ignore">
                        <h5 class="fs-title">@lang('messages.create_your_account')</h5>
                        <p class="fs-subtitle">@lang('messages.please_enter_your_login_details')</p>
                        <div class="container text-left">
                            <div class="form-group">
                                <label for="enter-email">@lang('messages.enter_your_email')</label>
                                {!! Form::email('email', old('email'), array('class'=>'form-control custom-h email_unique_validation', 'autocomplete' => 'off', 'id'=>'email',  'data-validate' =>'required,email', 'placeholder'=>'Enter your email')) !!}

                            </div>
                            <div class="form-group">
                                <label for="enter-username">@lang('messages.enter_your_username_or_handle') </label>
                                {!! Form::text('handle_name', old('handle_name'), array('class'=>'form-control custom-h handlename_unique_validation', 'autocomplete' => 'off', 'id'=>'handle_name',  'data-validate' =>'required,alphaunderscore', 'placeholder'=>'Enter your username/handle')) !!}
                            </div>

                            <div class="form-group">
                                <label for="enter-password">@lang('messages.enter_your_password') </label>
                                {!! Form::password('password', array('class'=>'form-control custom-h', 'autocomplete' => 'off', 'id'=>'password',  'data-validate' =>'required', 'placeholder'=>'Enter your password')) !!}
                            </div>
                            <div class="form-group">
                                <label for="enter-password-confirm">@lang('messages.enter_your_password_confirmation') </label>
                                {!! Form::password('confirm_password', array('class'=>'form-control custom-h', 'autocomplete' => 'off', 'id'=>'confirm_password',  'data-validate' =>'required,match:password', 'placeholder'=>'Enter your password confirmation')) !!}
                            </div>

                            <div class="form-check flex-check">
                                <div>
                                    <input type="checkbox" class="form-check-input checkbox-w" data-validate="required" id="term-condition">
                                    <label class="form-check-label " for="term-condition">@lang('messages.i_have_read_and_agree_with')<a
                                            href="#"> @lang('messages.termsandcondition')</a></label>
                                </div>
                            </div>
                            <div class="form-check flex-check">
                                <div>
                                    <input type="checkbox" class="form-check-input checkbox-w" id="newsletter-interest">
                                    <label class="form-check-label" for="newsletter-interest">@lang('messages.i_am_interested_in_mkp_newsletter')</label>
                                </div>
                            </div>
                        </div>
                        <input type="button" name="previous" class="previous action-button" value="@lang('messages.previous')" />
                        <input type="button" name="next" class="next action-button validate_next" value="@lang('messages.next')" />
                    </fieldset>

                    <fieldset class="ignore">
                        <h5 class="fs-title">@lang('messages.avatar')</h5>
                        <p class="fs-subtitle">@lang('messages.customize_your_profile')</p>
                        <div class="container">
                            <div class="row">

                                <div class="col-md-12">
                                    <i class="fa fa-id-card-o card-0" aria-hidden="true"></i>
                                </div>
                                <div class="col-md-12">
                                    <h3>@lang('messages.upload_a_picture_profile')</h3>
                                </div>

                                <div class="col-md-12 error_block" >
                                    {!! Form::file('pic', array('class'=>'imageUpload', 'data-max-size' => '1024', 'accept' => 'image/jpg,image/jpeg,image/png', 'data-validate' => 'required', 'id'=>'profile_picture', 'placeholder'=>'Profile picture')) !!}
                                    <span class='help-block text-danger'>Max profile image upload size is 1 MB.</span>
                                    <input type="hidden" name="profile_pic" id="uploadedProfileImage">
                                </div>
                            </div>
                        </div>
                        <input type="button" name="previous" class="previous action-button" value="@lang('messages.previous')" />
                        <input type="button" name="next" class="next action-button validate_profile_pic" value="@lang('messages.registerbtn')" />
                    </fieldset>

                {!! Form::close() !!}

            </div>


        </div>
    </section>


    @push('custom-script')
        <script src="{{ asset('/') }}home/js/register.js" type="text/javascript"></script>

        <script>
            $(".fa-info-circle").tooltip(); 

            var box_selected='';
            $(".selected_option").click(function(){
                $(".selected_option").removeClass("selected_option_border");
                $(this).addClass("selected_option_border")
                $('input[name=who_are_you]').val($(this).attr('data-box'));
                $('.nxt1').removeAttr('disabled');
            });

            $('.int_select').change(function() {
                var interests = $(this).val();
                $('.nxt_interest').attr('disabled', 'disabled');
                if(interests.length > 0) {
                    $('.nxt_interest').removeAttr('disabled');
                }
            });

            $(document).on('change', '#country_id', function(e) {
                e.preventDefault();
                var country_id = $(this).val();
                if (country_id != ''){
                    $.get("{{route('get.state')}}", {country_id: country_id})
                    .done(function (response) {
                        $('#state_id').html(response);
                    });
                }
            });

            $(document).on('change', '#state_id', function(e) {
                e.preventDefault();
                var state_id = $(this).val();
                if (state_id != ''){
                    $.get("{{route('get.city')}}", {state_id: state_id})
                    .done(function (response) {
                        // console.log(response);
                        $('#city_id').html(response);
                    });
                }
            });
            

            // on first focus (bubbles up to document), open the menu
            $(document).on('focus', '.select2-selection.select2-selection--single', function (e) {
                $(this).closest(".select2-container").siblings('select:enabled').select2('open');
            });

            // steal focus during close - only capture once and stop propogation
            $('select.select2').on('select2:closing', function (e) {
                $(e.target).data("select2").$selection.one('focus focusin', function (e) {
                    e.stopPropagation();
                });
            });

            $(document).on('change', '#how_did_you_hear_about', function(e) {
                e.preventDefault();
                $('.hear_from_other').addClass('hide');
                $('.sponsor_name_div').addClass('hide');
                if($(this).val() == 0) {
                    $('.sponsor_name_div').removeClass('hide');
                }
                if($(this).val() == 'Other') {
                    $('.hear_from_other').removeClass('hide');
                }
            });

            $(document).on('change', '.email_unique_validation', function(e) {
                if($(this).val() != "") {
                    $('.validate_next').removeAttr('disabled');
                    var email = $(this);
                    $.ajax({
                        url: "{{route('unique.email')}}",
                        type: 'POST',
                        data: {"_token": "{{ csrf_token() }}", 'email' : email.val()},
                        success: function(response) {
                            if(response == "true") {
                                email.parent().append("<span class='help-block text-danger error-msg'>This email is already used!</span>")
                                $('.validate_next').attr('disabled', 'disabled');
                            }
                        }
                    })
                }
            });
            $(document).on('change', '.handlename_unique_validation', function(e) {
                if($(this).val() != "") {
                    $('.validate_next').removeAttr('disabled');
                    var handle_name = $(this);
                    $.ajax({
                        url: "{{route('unique.handlename')}}",
                        type: 'POST',
                        data: {"_token": "{{ csrf_token() }}", 'handle_name' : handle_name.val()},
                        success: function(response) {
                            if(response == "true") {
                                handle_name.parent().append("<span class='help-block text-danger error-msg'>This handlename is already used!</span>")
                                $('.validate_next').attr('disabled', 'disabled');
                            }
                        }
                    })
                }
            });

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
        </script>

        <script>
            // $(document).ready(function(){

                $profile_image_crop = $('#image_demo').croppie({
                    enableExif: true,
                    viewport: {
                        width:278,
                        height:370,
                        type:'rectacngle' //circle
                    },
                    boundary:{
                        width:378,
                        height: 420
                    }
                });

                $(document).on('change', '#profile_picture', function(){
                    
                    var fileInput = $(this);
                    var maxSize = fileInput.attr('data-max-size');
                    if(fileInput.get(0).files.length){
                        var fileSize = fileInput.get(0).files[0].size;
                        
                        if((fileSize/1024)>maxSize){
                            alert('profile picture should not more than ' + (maxSize/1024) + ' MB');
                            $('.validate_profile_pic').attr('disabled', 'disabled');
                            return false;
                        } else {
                            $('.validate_profile_pic').removeAttr('disabled');

                            var reader = new FileReader();
                            reader.onload = function (event) {
                                $profile_image_crop.croppie('bind', {
                                    url: event.target.result
                                }).then(function(){
                                    console.log('jQuery bind complete');
                                });
                            }
                            reader.readAsDataURL(this.files[0]);
                            $('#uploadprofileimgModal').modal('show');
                        }
                    }
                    
                });

                $('.crop_image').click(function(event){
                    $profile_image_crop.croppie('result', {
                        type: 'canvas',
                        size: 'viewport'
                    }).then(function(response){
                        $.ajax({
                            url:"{{ route('upload.profile.picture') }}",
                            type: "POST",
                            data:{"_token": "{{ csrf_token() }}", "image": response},
                            success:function(data) {
                                res = JSON.parse(data);
                                $('#uploadprofileimgModal').modal('hide');
                                $('#uploadedProfileImage').val(res.img_name);
                            }
                        });
                    })
                });

            // });  
        </script>
    @endpush
@endsection
