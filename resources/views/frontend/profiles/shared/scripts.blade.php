

<!-- code to load visible modal -->
@include('frontend.visible.visible_modal')   

<!-- Code to load send deal modal -->
@include('frontend.media_popup.media_modal')

@if(!$can_update)
    @if(Auth::guard('user')->check())
        @include('frontend.deallist.send_deal_modal')

        @include('frontend.profiles.shared.profile_follow_modal')
        @include('frontend.profiles.shared.profile_report_modal')
        
    @endif
@endif
        
@include('frontend.deallist.reply_deal_modal')

{!! Form::open(array('method' => 'post', 'route' => 'delete.profile.media', 'class' => 'form', 'id' => 'delete_profile_media', 'files'=>true)) !!}
    <input type="hidden" id="profile_media_id" name="media_id">
{!! Form::close() !!}

<input type="hidden" id="picture_url" value="{{route('load.media', ['media_id' => (!empty($_GET['open']) ? \General::getProfilePicMediaId($user_profile_id) : ''), 'user_profile_id' => $user_profile_id, 'profile_id' => $profile_id, 'tbl' => 'UsersProfilePicture'])}}">
<input type="hidden" id="media_url" value="{{route('load.media', ['media_id' => (!empty($_GET['media']) ? $_GET['media'] : ''), 'user_profile_id' => $user_profile_id, 'profile_id' => $profile_id, 'tbl' => 'UsersProfileMedia']) }}">

@push('custom-script') 
    <script>
        
        $("#review").click(function(){
            $(".main-profile-box").toggleClass("hide-main-profile-box");
            $("#arrow-up").toggleClass("hide-main-profile-box");
            $("#review-box").toggleClass("show-review-box");
            // inner-review-box
            $.ajax({
                url: "{{ route('users.review') }}",
                type: 'post',
                data: {_token: '{{ csrf_token() }}', profile_id: '{{$profile_id}}', users_profiles_id: '{{ $user_profile_id}}'},
                success:function(response) {
                    // console.log(response);
                    var res = JSON.parse(response);
                    $('.inner-review-box').html(res.html);
                    $('.review_count').html(res.review_count);
                }
            });
        });

        $(document).on('click', '.delete__review', function(e) {
            e.preventDefault();
            var review_id = $(this).attr('data-id');
            if(confirm('Are you sure you want to delete review?')) {
                $.ajax({
                    url: "{{ route('delete.review') }}",
                    type: 'post',
                    data: {_token: '{{ csrf_token() }}', review_id: review_id },
                    success:function(response) {
                        location.reload(true);
                    }
                });
            }
        });



        var audio_player = [];
        // Load Profile overview using ajax
        $(document).ready(function() {
            loadOverview();

            loadBasicInfo();
            loadProfileMedia();
            loadProfileMusic();

            var url_param = document.URL.match(/open=([A-Za-z]+)/)
            
            setTimeout(() => {
                if(url_param != null && url_param[1] == "picture") {
                        openModal('media-info-modal', $('#picture_url').val());
                } else if(url_param != null && url_param[1] == "media") {
                    openModal('media-info-modal', $('#media_url').val());
                } else if(url_param != null && url_param[1] == "music") {
                    $([document.documentElement, document.body]).animate({
                        scrollTop: $("#scroll_to_music").offset().top
                    }, 2000);
                }
            }, 500);
        });
        
        function loadOverview() {
            $.ajax({
                url: "{{ route('get.profile.overview') }}",
                type: 'post',
                data: {_token: '{{ csrf_token() }}', profile_id: '{{$profile_id}}', user: '{{ $user_profile_id}}'},
                success:function(response) {
                    $('.main-profile-box').html(response);
                }
            });
        }
        
        function loadBasicInfo() {
            if($('.main-pro-tbl-box').length > 0){

                $.ajax({
                    url: "{{ route('get.profile.basic.info') }}",
                    type: 'post',
                    data: {_token: '{{ csrf_token() }}', profile_id: '{{$profile_id}}', user: '{{ $user_profile_id}}'},
                    success:function(response) {
                        $('.main-pro-tbl-box').html(response);
                    }
                });
                
            }
        }
        
        var start = 0;
        var limit = 9;

        function loadProfileMedia() {
            
            $.ajax({
                url: "{{ route('get.profile.media') }}",
                type: 'get',
                data: {_token: '{{ csrf_token() }}', start: start, limit: limit, profile_id: '{{$profile_id}}', user: '{{ $user_profile_id}}'},
                success:function(response) {
                    var res = JSON.parse(response);

                    if(start == 0) {
                        $('.media__display').html(res.html);
                    } else {
                        $('.media__display').append(res.html);
                    }
                    
                    $('#load__more').html('See More Media');

                    if(res.show_btn == 'true') {
                        $('#load__more').removeClass('hide')
                    } else {
                        if(start != 0) {
                            $('#no__more__media').removeClass('hide')
                        }
                        $('#load__more').addClass('hide')
                    }

                    start = (start + limit);
                }
            });
        }

        $(document).on('click', '#flip', function(e) {
            $('.show_or_hide_media').toggleClass('hide');
            $.ajax({
                url: "{{ route('get.profile.archive.media') }}",
                type: 'get',
                data: {_token: '{{ csrf_token() }}', profile_id: '{{$profile_id}}', user: '{{ $user_profile_id}}'},
                success:function(response) {
                    var res = JSON.parse(response);
                    $('.media__archive__display').html(res.html);
                }
            });
        });
        

        $(document).on('click', '#load__more', function(e) {
            e.preventDefault();
            limit = 3;
            $(this).html('<i class="fa fa-spinner fa-spin"></i> Loading');
            loadProfileMedia();
        })

        $(document).on('click', '.see_more_btn', function(e) {
            $('.read_less').toggleClass('hide');
            // $('.see_more_btn').toggleClass('hide');
            if($('.see_more_btn').html() == "See More"){
                $('.see_more_btn').html("See Less");
            }else{                   
                $('.see_more_btn').html("See More");
            }
        });


        var start_music = 0;
        var limit_music = 5;

        function loadProfileMusic() {
            if($('.profile-music-section').length) {

                $.ajax({
                    url: "{{ route('get.profile.music') }}",
                    type: 'get',
                    data: {_token: '{{ csrf_token() }}', start: start_music, limit: limit_music, profile_id: '{{$profile_id}}', user: '{{ $user_profile_id}}'},
                    success:function(response) {
                        // console.log(response);
                        var res = JSON.parse(response);
    
                        if(start_music == 0) {
                            $('.profile-music-section').html(res.html);
                        } else {
                            $('.profile-music-section').append(res.html);
                        }
                        
                        $('#load__more__music').html('See More Music');
    
                        if(res.show_btn == 'true') {
                            $('#load__more__music').removeClass('hide')
                        } else {
                            if(start_music != 0) {
                                $('#no__more__music').removeClass('hide')
                            }
                            $('#load__more__music').addClass('hide')
                        }
    
                        start_music = (start_music + limit_music);
                    }
                });

            }
        }

        $(document).on('click', '#load__more__music', function(e) {
            e.preventDefault();
            limit = 3;
            $(this).html('<i class="fa fa-spinner fa-spin"></i> Loading');
            loadProfileMusic();
        });

        function deleteMedia(media_id) {
            if(confirm('Are you sure you want to delete media?')) {
                $('#delete_profile_media').find('#profile_media_id').val(media_id);
                $('#delete_profile_media').submit();
            }
        }
        
        function likeMedia(element, media_id) {
            // like.profile.media
            $.ajax({
                url: "{{ route('like.profile.media') }}",
                type: 'post',
                data: {_token: '{{ csrf_token() }}', media_id: media_id, profile_id: '{{$profile_id}}', user: '{{ $user_profile_id}}'},
                success:function(response) {
                    var likes = $('.' + element).find('.like__count').text();
                    $('.' + element).find('.fill__like').toggleClass('red-heart')
                    if(response == "false") {
                        $('.' + element).find('.like__count').html((parseInt(likes) - 1));
                    } else {
                        $('.' + element).find('.like__count').html((parseInt(likes) + 1));
                    }
                }
            });
        }
        
        
        function playMediaCount(element, media_id) {
            // like.profile.media
            
            $.ajax({
                url: "{{ route('play.profile.media') }}",
                type: 'post',
                data: {_token: '{{ csrf_token() }}', media_id: media_id, profile_id: '{{$profile_id}}', user: '{{ $user_profile_id}}'},
                success:function(response) {
                    if("{{Auth::guard('user')->check()}}") {

                        var play_count = $('.' + element).find('.play__count').text();
                        if(response == "false") {
                            $('.' + element).find('.play__count').html((parseInt(play_count) - 1));
                        } else {
                            $('.' + element).find('.play__count').html((parseInt(play_count) + 1));
                        }
                        
                    }
                }
            });
        }
        
    </script>

    
    <!---- Send Keypeople request -->
    <script>
        $(document).on('click','#request_keypeople_submit',function(e){
            e.preventDefault();
            $('.error-text').html("");

            if(validateRegister($('#request_keypeople_form')) == false){
                return false;
            } else {
                var submit_btn = $(this);
                submit_btn.attr('disabled', 'disabled');

                // ajax submit
                var form_data = new FormData(document.getElementById("request_keypeople_form"));

                $.ajax({
                    url: "{{ route('send.keypeople.request') }}",
                    type: 'post',
                    processData: false,
                    contentType: false,
                    data: form_data,

                    success: function(result){
                        var res = JSON.parse(result);
                        if(res.status == 400) {
                            submit_btn.removeAttr('disabled');
                            $('.error-text').html(res.msg);
                        } else {
                            alert("Your Key People request has been sent")
                            location.reload(true);
                        }
                    }
                })
            }
        });

        $('#already_know_this_person').on('hidden.bs.modal', function (e) {
            $('#request_keypeople_form')[0].reset();
            $('#request_keypeople_form').find('.error-text').html("");
            $('#request_keypeople_form').find('.error-msg').remove();
            $('#request_keypeople_submit').removeAttr('disabled');
        })

        $('#media-info-modal').on('hidden.bs.modal', function (e) {
            $('#media-info-modal').find('.modelDataLoad').html("");
        })

    </script>
       
  
@endpush
