@extends('frontend.layouts.layout')

@section('content')

    @push('custom-style')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css">
    @endpush
    
    @include('frontend.profiles.menu.profile_menu')

    <section class="main-profile">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="profile-img-area">
                        @if($profile_overview->profile_pic == "default.png")
                            <img src="{{ asset('/')}}home/images/{{$profile_overview->profile_pic}}" class="my-profile-img" >
                        @else
                            <img src="{{ asset('/')}}uploads/profile_picture/{{$profile_overview->profile_pic}}" class="my-profile-img" onclick="openModal('media-info-modal', '{{route('load.media', ['media_id' => \General::getProfilePicMediaId($user_profile_id, $profile_overview->profile_pic), 'user_profile_id' => $user_profile_id, 'profile_id' => $profile_id, 'tbl' => 'UsersProfilePicture'])}}')">
                        @endif
                        @if ($can_update)
                            <i class="fa fa-camera" aria-hidden="true" id="camera-white-icon" onclick="openModal('update_profile_pic_Modal', '{{route('edit.profile.picture', ['profile_id' => $profile_id, 'user_profile' => $user_profile_id])}}')" ></i>
                        @endif
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-5">
                            <h3>{{$profile_overview->full_name}} ({{$profile_overview->gender == "Male" ? 'M' : ($profile_overview->gender == "Female" ? 'F' : 'Nby')}}, {{ $profile_overview->age() }})
                                @if ($can_update)
                                    <i class="fa fa-pencil edit-icon" onclick="openModal('edit_profile', '{{route('edit.profile', ['profile_id' => $profile_id, 'user_profile' => $user_profile_id])}}')" aria-hidden="true" ></i>
                                @endif

                                @if (Cache::has('online-' . $profile_overview->users_id))
                                    <i class='fa fa-circle online' aria-hidden='true' title="Online"></i>
                                @else
                                    <i class='fa fa-circle offline' aria-hidden='true' title="Offline"></i>
                                @endif
                                
                                @if ($profile_overview->profile_badge == 1)
                                    <img style="" class="img-profile-icon" src="{{asset('/') . 'home/images/rep_mkp.png'}}" title="Represented by MKP">
                                @elseif ($profile_overview->profile_badge == 2)
                                    <img style="" class="img-profile-icon" src="{{asset('/') . 'home/images/rec_vip.png'}}" title="VIP">
                                @elseif ($profile_overview->profile_badge == 3)
                                    <img style="" class="img-profile-icon" src="{{asset('/') . 'home/images/rec_mkp.png'}}" title="Recommended by MKP">
                                @endif

                            </h3>
                            <h5 class="designation-txt">
                                Marketplace
                            </h5>
                            <p class="profile-user-add">{{ $profile_overview->getCity('title') }}, {{ $profile_overview->getState('title') }}, {{ $profile_overview->getCountry('title') }}</p>
                            <p class="main-profile-para-txt">{{ $profile_overview->description }}</p>

                            @if(!empty($profile_overview->website))
                                <div class="profile_link">
                                    <span>
                                        <i class="fa fa-globe" aria-hidden="true"></i>
                                        <a href="{{ $profile_overview->website }}" target="_blank" class="profile-a-link">{{ $profile_overview->website }} </a>
                                    </span>
                                </div>
                            @endif

                            <div class="profile-social-icon">
                                @if(!empty($social_media))
                                    @foreach ($social_media as $key => $value)
                                        @if($key == "cv")
                                            @if($value == "yes")
                                                <div>
                                                    <img src="{{ asset('/') }}home/images/social-icons/{{ $key }}.png" >
                                                </div>
                                            @endif
                                        @else
                                            <div>
                                                <a href="{{$value}}" target="_blank">
                                                    <img src="{{ asset('/') }}home/images/social-icons/{{ $key }}.png" >
                                                </a>
                                            </div>
                                        @endif                                        
                                    @endforeach
                                @endif
                                @if($can_update)
                                    <div>
                                        <i class="fa fa-plus" aria-hidden="true" data-toggle="modal"
                                            data-target="#add_social_media"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="plus-text-area">
                                <?php $click_event = "openModal('add_to_key_list', '". route('add.to.keylist', ['profile_id' => $profile_id, 'user_profile' => $user_profile_id, 'media_type' => 'UsersProfile' ]). "')"; ?>
                                
                                <i class="fa fa-plus" aria-hidden="true" onclick="{{ $can_update ? $click_event : 'return false' }}"></i>
                                <p class="add-key-text"><strong>@lang('messages.add_to_key_list')</strong></p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            
                            @include('frontend.profiles.shared.profile_deal_section')


                            <button type="button" class="btn project-btn">
                                @lang('messages.projects') <span class="numberCircle">10</span>
                            </button>

                            <div class="dropdown">
                                <button class="btn dropdown-toggle share-profile-btn" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @lang('messages.share_profile') <span><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                                </button>
                                @if(Auth::guard('user')->check())
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#to_your_feed">@lang('messages.to_your_feed')</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#to_key_people">@lang('messages.to_key_people')</a>
                                        <a class="dropdown-item" href="#">@lang('messages.copy_link')</a>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="job-overview-box">
                        @include('frontend.profiles.shared.profile_counts')
                    </div>
                </div>
                <div class="col-md-9">
                    @include('frontend.profiles.shared.profile_review')
                    {{-- Content loaded using ajax --}}
                    <div class="main-profile-box" >
                        <i class="fa fa-spinner fa-spin"></i>
                    </div>
                    <div class="copy_main-profile-box"></div>
                    <div class="arrow-down-up" id="arrow-up">
                        <i class="fa fa-angle-down" aria-hidden="true" id="v-flip-arrow" ></i>
                    </div>
                </div>
            </div>
            
            @if(!$can_update)
                @if(Auth::guard('user')->check())
                    @include('frontend.profiles.shared.profile_follow_report')
                @endif
            @endif

        </div>
    </section>
        
    @include('frontend.profiles.shared.profile_media')


    {{-- Load profile social media modal --}}
    <div class="modal fade" id="add_social_media" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateprofilepicModalLabel"> @lang('messages.add') @lang('messages.social_media')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(array('method' => 'post', 'route' => 'update.social.media', 'class' => 'form', 'id' => 'profile_social_form', 'files'=>false)) !!}
                    
                        <input type="hidden" name="users_profiles_id" value="{{$user_profile_id}}">
                        
                        <div class="col-md-12 text-left flex-cv-radio-row">
                            <div class="form-check-inline">
                                <img class="social_icon" src="{{ asset('/') }}home/images/social-icons/cv.png">
                                <label class="form-check-label">@lang('messages.cv')</label>
                            </div>
                            {!! Form::hidden('social_media[]', "cv", array('class'=>'form-control custom-h', 'autocomplete' => 'off')) !!}
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="social_media_link[]" id="inlineRadio1" value="yes">
                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                            </div>
                        
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="social_media_link[]" id="inlineRadio2" checked value="no">
                                <label class="form-check-label" for="inlineRadio2">No</label>
                            </div>    
                        </div>
        
                        <div class="col-md-12 text-left py-4">
                            <label>
                                <img class="social_icon" src="{{ asset('/') }}home/images/social-icons/facebook.png"> @lang('messages.facebook')
                            </label>
                            {!! Form::hidden('social_media[]', "facebook", array('class'=>'form-control custom-h', 'autocomplete' => 'off')) !!}
                            {!! Form::url('social_media_link[]', (!empty($social_media['facebook']) ? $social_media['facebook'] : Null ), array('class'=>'form-control custom-h', 'autocomplete' => 'off', 'data-validate' =>'url,match_any_one:facebook.')) !!}
                        </div>
                        <div class="col-md-12 text-left py-2">
                            <label>
                                <img class="social_icon" src="{{ asset('/') }}home/images/social-icons/linkedin.png"> @lang('messages.linkedin')
                            </label>
                            {!! Form::hidden('social_media[]', "linkedin", array('class'=>'form-control custom-h', 'autocomplete' => 'off')) !!}
                            {!! Form::url('social_media_link[]', (!empty($social_media['linked']) ? $social_media['linked'] : Null ), array('class'=>'form-control custom-h', 'autocomplete' => 'off', 'data-validate' =>'url,match_any_one:linkedin.')) !!}
                        </div>
                        <div class="col-md-12 text-left py-2">
                            <label>
                                <img class="social_icon" src="{{ asset('/') }}home/images/social-icons/instagram.png"> @lang('messages.instagram')
                            </label>
                            {!! Form::hidden('social_media[]', "instagram", array('class'=>'form-control custom-h', 'autocomplete' => 'off')) !!}
                            {!! Form::url('social_media_link[]', (!empty($social_media['instagram']) ? $social_media['instagram'] : Null ), array('class'=>'form-control custom-h', 'autocomplete' => 'off', 'data-validate' =>'url,match_any_one:instagram.')) !!}
                        </div>
                        <div class="col-md-12 text-left py-2">
                            <label>
                                <img class="social_icon" src="{{ asset('/') }}home/images/social-icons/youtube.png"> @lang('messages.youtube')
                            </label>
                            {!! Form::hidden('social_media[]', "youtube", array('class'=>'form-control custom-h', 'autocomplete' => 'off')) !!}
                            {!! Form::url('social_media_link[]', (!empty($social_media['youtube']) ? $social_media['youtube'] : Null ), array('class'=>'form-control custom-h', 'autocomplete' => 'off', 'data-validate' =>'url,match_any_one:youtube.')) !!}
                        </div>
                        <div class="col-md-12 text-left py-2">
                            <label>
                                <img class="social_icon" src="{{ asset('/') }}home/images/social-icons/twitter.png"> @lang('messages.twitter')
                            </label>
                            {!! Form::hidden('social_media[]', "twitter", array('class'=>'form-control custom-h', 'autocomplete' => 'off')) !!}
                            {!! Form::url('social_media_link[]', (!empty($social_media['twitter']) ? $social_media['twitter'] : Null ), array('class'=>'form-control custom-h', 'autocomplete' => 'off', 'data-validate' =>'url,match_any_one:twitter.')) !!}
                        </div>
                        <div class="col-md-12 text-left py-2">
                            <label>
                                <img class="social_icon" src="{{ asset('/') }}home/images/social-icons/snapchat.png"> @lang('messages.snapchat')
                            </label>
                            {!! Form::hidden('social_media[]', "snapchat", array('class'=>'form-control custom-h', 'autocomplete' => 'off')) !!}
                            {!! Form::url('social_media_link[]', (!empty($social_media['snapchat']) ? $social_media['snapchat'] : Null ), array('class'=>'form-control custom-h', 'autocomplete' => 'off', 'data-validate' =>'url,match_any_one:snapchat.')) !!}
                        </div>
                        <div class="col-md-12 text-left py-2">
                            <label>
                                <img class="social_icon" src="{{ asset('/') }}home/images/social-icons/tinder.png"> @lang('messages.tinder')
                            </label>
                            {!! Form::hidden('social_media[]', "tinder", array('class'=>'form-control custom-h', 'autocomplete' => 'off')) !!}
                            {!! Form::url('social_media_link[]', (!empty($social_media['tinder']) ? $social_media['tinder'] : Null ), array('class'=>'form-control custom-h', 'autocomplete' => 'off', 'data-validate' =>'url,match_any_one:tinder.')) !!}
                        </div>
                        <div class="col-md-12 text-left py-2">
                            <label>
                                <img class="social_icon" src="{{ asset('/') }}home/images/social-icons/fiverr.png"> @lang('messages.fiverr')
                            </label>
                            {!! Form::hidden('social_media[]', "fiverr", array('class'=>'form-control custom-h', 'autocomplete' => 'off')) !!}
                            {!! Form::url('social_media_link[]', (!empty($social_media['fiverr']) ? $social_media['fiverr'] : Null ), array('class'=>'form-control custom-h', 'autocomplete' => 'off', 'data-validate' =>'url,match_any_one:fiverr.')) !!}
                        </div>
                        <div class="col-md-12 text-left py-2">
                            <label>
                                <img class="social_icon" src="{{ asset('/') }}home/images/social-icons/tiktok.png"> @lang('messages.tiktok')
                            </label>
                            {!! Form::hidden('social_media[]', "tiktok", array('class'=>'form-control custom-h', 'autocomplete' => 'off')) !!}
                            {!! Form::url('social_media_link[]', (!empty($social_media['tiktok']) ? $social_media['tiktok'] : Null ), array('class'=>'form-control custom-h', 'autocomplete' => 'off', 'data-validate' =>'url,match_any_one:tiktok.')) !!}
                        </div>
                        <div class="col-md-12 text-left py-2">
                            <button type="submit" onclick="return validateRegister($('#profile_social_form'));" class="btn bg-btn-color btn-color-w btn-lg btn-block">@lang('messages.save')</button>
                        </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
    {{-- Load profile social media modal --}}


    {{-- Load profile update modal here --}}
    <div class="modal fade" id="edit_profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateprofilepicModalLabel">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-left">
                    <div class="modelDataLoad">

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Load profile update modal here --}}

    {{-- Load profile picture modal here --}}
    <div class="modal fade" id="update_profile_pic_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateprofilepicModalLabel">Update Profile Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modelDataLoad">
                
                </div>
            </div>
        </div>
    </div>
    {{-- Load profile picture modal here --}}
  

    <!-- code to load keylist modal -->
    @include('frontend.keylist.shared.keylist_modal')
    
    <!-- code to load Deal List modal -->
    @include('frontend.deallist.deal_list_modal')

    <!-- code to load profile_overview, basic info -->
    @include('frontend.profiles.shared.scripts')   
   
    @push('custom-script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
    @endpush

@endsection