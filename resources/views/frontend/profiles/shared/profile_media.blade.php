@if($can_update)
    <section class="main-profile-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 text-left">
                    <i class="fa fa-archive archive-icon" aria-hidden="true" id="flip"></i>
                </div>
                <div class="col-md-6 text-right ml-auto flex-item">
                    <div class="add_media_txt">@lang('messages.add') @lang('messages.media')</div>
                    <div class="circle-plus-icon" data-toggle="modal" data-target="#add_media">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

<div id="media__display">
    <section class="main-profile-4" id="main-p-4">
        <div class="container-fluid">
            <div class="row mb-15">
                <div id="photos" class="media__display show_or_hide_media">
                    <i class="fa fa-spinner fa-spin"></i>
                </div>
                <div id="photos" class="media__archive__display show_or_hide_media hide">
                    <i class="fa fa-spinner fa-spin"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="hide" id="no__more__media">No Media Available!</p>
                    <button class="btn btn-primary hide" id="load__more">See More Media</button>
                </div>
                
            </div>
        </div>
    </section>
</div>



{{-- Load media modal here --}}
<!-- Modal Start Add Media  -->
<div class="modal fade  bd-example-modal-lg" id="add_media" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateprofilepicModalLabel"> @lang('messages.add') @lang('messages.media') </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex">
                    <div class="col-md-4">
                        <div class="new_music" onclick="openModal('add_image_pdf', '{{route('get.profile.image.media', ['profile_id' => $profile_id, 'user' => $user_profile_id])}}')" >
                            <div>
                                <i class="fa fa-plus circle-icon-b" aria-hidden="true"></i>
                                <p>@lang('messages.add') @lang('messages.image_pdf')</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="new_music" onclick="openModal('add_vedio', '{{route('get.profile.video.media', ['profile_id' => $profile_id, 'user' => $user_profile_id])}}')" >
                            <div>
                                <i class="fa fa-plus circle-icon-b" aria-hidden="true"></i>
                                <p>@lang('messages.add') @lang('messages.video')</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="new_music" onclick="openModal('add_soundcloud_spotify', '{{route('get.profile.audio.media', ['profile_id' => $profile_id, 'user' => $user_profile_id])}}')" >
                            <div>
                                <i class="fa fa-plus circle-icon-b" aria-hidden="true"></i>
                                <p>@lang('messages.add') @lang('messages.soundcloud_spotify')</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->

{{-- Add Image modal --}}
<div class="modal fade" id="add_image_pdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateprofilepicModalLabel"><p>@lang('messages.add') @lang('messages.image_pdf')</p></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modelDataLoad">
            
            </div>
        </div>
    </div>
</div>  
{{-- Add Image modal --}}

{{-- Add Video modal --}}
<div class="modal fade" id="add_vedio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateprofilepicModalLabel">@lang('messages.add') @lang('messages.video')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modelDataLoad">
            
            </div>
        </div>
    </div>
</div>
{{-- Add Video modal --}}

{{-- Add Audio modal --}}
<div class="modal fade" id="add_soundcloud_spotify" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateprofilepicModalLabel">@lang('messages.add') @lang('messages.url')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modelDataLoad">
            </div>
        </div>
    </div>
</div>
{{-- Add Audio modal --}}