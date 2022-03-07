<section class="add_music_section">
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-md-6 text-left">

            </div>
            @if($can_update)
                <div class="col-md-6 text-right ml-auto flex-item">
                    <div class="add_media_txt">@lang('messages.add') @lang('messages.music')</div>
                    <div class="circle-plus-icon bgRed" onclick="openModal('add_music_modal', '{{route('add.music', ['profile_id' => $profile_id, 'user_profile' => $user_profile_id])}}')" >
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </div>
                </div>
            @endif

        </div>

        <div class="row my-3">
            <div class="container-fluid">
                <div class="profile-music-section">
                    <i class="fa fa-spinner fa-spin"></i>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center mt-2">
                        <p class="hide" id="no__more__music">No Music Available!</p>
                        <button class="btn hide" id="load__more__music">See More Music</button>
                    </div>
                    
                </div>
            </div>
        </div>


    </div>
</section>
