<div class="modal-body remove-space">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="row bg-black">
        <div class="col-md-12 col-lg-7 o-hidden">
            <div class="row zoom-and-plus">
                <div class="text-left pr-0">
                    <i class="fa fa-expand fa-white-icon do_full_screen" aria-hidden="true" ></i>
                </div>
                <div class="text-right align-right pr-0">
                    <div class="cir-plus" onclick="openModal('add_to_key_list', '{{route('add.to.keylist', ['profile_id' => $media_detail->profile_id, 'user_profile' => $media_detail->id, 'media_type' => $tbl ])}}' )">
                        <i class="fa fa-plus cir-pl" aria-hidden="true"></i>
                    </div>
                    <div class="z-index-i" >
                        <p class="col-white">Add to key list</p>
                    </div>

                </div>
            </div>
            <div id="left-modal-panel">
                <?php $extension = pathinfo($media_detail->image_path, PATHINFO_EXTENSION); 

                switch($extension) {
                    case('jpg'): case('png'): case('jpeg'):                        
                        echo '<img class="modal-content  d-block w-100 portrait-img" src="'.$media_detail->image_path.'" id="make__fullscreen">';
                        break;
                    case('mp4'):
                        echo '<video src="'.$media_detail->image_path.'" id="make__fullscreen" class="oth-video" autobuffer="" preload="metadata" autoloop="" loop="" controls="" poster="/images/video.png" style="width:100%;"></video>';                        
                        break;
                    case('pdf'):
                        echo '<iframe width="100%" height="400" class="portrait-video" id="make__fullscreen" scrolling="auto" frameborder="no" src="'.$media_detail->image_path.'#view=fit" embedded="true"></iframe>';
                        break;
                    default:
                        if (strpos($media_detail->image_path, 'youtube.') !== false) {
                            $youtube_id = substr($media_detail->image_path, strpos($media_detail->image_path, "=") + 1);
                            $src = 'https://www.youtube.com/embed/'.$youtube_id.'?controls=1';

                            echo '<iframe width="527" height="370" id="make__fullscreen" class="youtube-iframe" src="'.$src.'"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>';

                        } else if (strpos($media_detail->image_path, 'vimeo.') !== false) {
                            try{
                                
                                $getValues = file_get_contents('https://vimeo.com/api/oembed.json?url='.$media_detail->image_path);
                                $jsonObj = json_decode($getValues);
                                preg_match_all("/<iframe[^>]*src=[\"|']([^'\"]+)[\"|'][^>]*>/i", $jsonObj->html, $source );
                                $src = $source[1][0];

                                echo '<iframe width="527" height="370" id="make__fullscreen" class="youtube-iframe" src="'.$src.'"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>';

                            } catch (Exception $e) {
                            }
                        } else if (strpos($media_detail->image_path, 'soundcloud.com') !== false) {
                            try{
                                $getValues=file_get_contents('http://soundcloud.com/oembed?format=js&url='.$media_detail->image_path.'&iframe=true');
                                $decodeiFrame=substr($getValues, 1, -2);
                                $jsonObj = json_decode($decodeiFrame);
                                preg_match_all("/<iframe[^>]*src=[\"|']([^'\"]+)[\"|'][^>]*>/i", $jsonObj->html, $source );
                                $src = $source[1][0];

                                echo '<iframe width="100%" height="400" id="make__fullscreen" class="portrait-video" scrolling="no" frameborder="no" src="'.$src.'"></iframe>';

                            } catch (Exception $e) {

                            }
                        } else {
                            $spotify_split_urls = explode('/', $media_detail->image_path);
                            $src = "https://open.spotify.com/embed/" . $spotify_split_urls[count($spotify_split_urls)-2] . '/' . $spotify_split_urls[count($spotify_split_urls) - 1];
                            echo '<iframe width="100%" height="400" id="make__fullscreen" class="portrait-video" scrolling="no" frameborder="no" src="'.$src.'" ></iframe>';
                        }
                        
                        break;       
                }
                ?>
                
            </div>
        </div>
        <div class="col-md-12 col-lg-5 px-0" id="right-side-panel">
            @if($can_update && $tbl != 'UsersProfilePicture')
                <div class="row px-3">
                    <div class="col-md-11"></div>
                    <div class="col-md-1 text-right">
                        <div class="unlock-circle" onclick="openModal('unlock-llc', '{{route('update.visible', ['tbl' => $tbl, 'curr_visible' => $media_detail->locked , 'media_id' => $media_detail->id, 'profile_id' => $profile_id, 'user_profile' => $user_profile_id])}}')">
                            <i class="fa fa-{{ $media_detail->locked <= 1 ? 'unlock' : 'lock' }} unlock-fa-icon" id="lock__{{ $media_detail->id }}" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row pt-2 px-3">
                <div class="col-md-6 text-left">
                    <b>Description</b>
                </div>
                @if($can_update)
                    <div class="col-md-6 text-right three-icon">
                        <i class="fa fa-trash-o" onclick="deleteProfileMedia({{$media_detail->id}}, '{{$tbl}}')"  aria-hidden="true"></i>
                        @if($tbl != 'UsersProfilePicture')
                            <i class="fa fa-archive {{$media_detail->is_archived == 0 ? 'text-black' : ''}}" onclick="archiveMedia({{$media_detail->id}}, {{$media_detail->is_archived}}, '{{$tbl}}')" aria-hidden="true"></i>
                        @endif
                        <i class="fa fa-pencil edit-text-area" aria-hidden="true"></i>
                        <i class="fa fa-times fa-close-cancel" aria-hidden="true"></i>
                    </div>
                @endif
            </div>

            <div class="row pt-2 px-3">
                <div class="col-md-12 text-left">
                    <p id="display__media__description" class="text-anchor-tag">
                        <?php echo $media_detail->description ?>
                    </p>
                    <p id="media__description" class="tribute-demo-input text-area">
                        <?php echo $media_detail->description ?>
                    </p>
                </div>
                <div class="col-md-12 text-right">
                    <button type="button" id="update__media__desc" data-id="{{ $media_detail->id }}" data-tbl="{{ $tbl }}"  class="update-btn">Update</button>
                </div>
            </div>

            <div class="row py-1 a-v-center px-3">
                <div class="col-md-3 text-left">
                    <label class="mb-0"><b>With</b></label>
                </div>
                <div class="col-md-9 text-left">
                    <select name="tag_user_ids" class="form-control media_tagged_user" id="tag_user_ids" data-id="{{$media_detail->id}}" data-tbl="{{$tbl}}" multiple='multiple' {{ (!$can_update ? 'disabled="disabled"' : "")}}>
                        @foreach ($keypeoples as $key => $value)
                            <option value="{{ $value->receiver_id}}" data-handlename="{{ $value->handle_name }}" {{ in_array($value->receiver_id, explode(',', $media_detail->tag_user_ids)) ? 'selected' : '' }}>{{ $value->full_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row py-1 a-v-center px-3">
                <div class="col-md-3 text-left">
                    <label class="mb-0"><b>Location</b></label>
                </div>
                <div class="col-md-9">
                    <input type="hidden" id="selected__media__location" value="{{ $media_detail->location_id }}" data-tbl="{{$tbl}}" data-id="{{$media_detail->id}}" data-search="{{route('search.media.location')}}" data-url="{{route('update.media.location')}}">
                    <input id="media__location" type="text" autocomplete="off" class="form-control" value="{{ !empty($media_detail->location_id) ? \General::getLocation($media_detail->location_id) : ''}}" {{ !$can_update ? 'readonly disabled' : '' }}>
                </div>
            </div>
            <hr class="mb-0">
            <div class="row py-1 a-v-center px-3">
                <div class="col-md-4 text-left">

                </div>
                <div class="col-md-2">
                    <div class="dropdown">
                        <i class="fa fa-share dropbtn" aria-hidden="true"></i>
                        <span>0</span>
                        <div class="dropdown-content">
                            <a href="#" data-toggle="modal" data-target="#to_your_feed">To Your Feed</a>
                            <a href="#" data-toggle="modal" data-target="#to_key_people">To Key People</a>
                            <a href="#">Copy Link</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <i class="fa fa-comment-o" id="main-chat" aria-hidden="true"></i>
                    <span><?php echo $comment_count ?></span>
                </div>
                <div class="col-md-2">
                    <?php 
                        $like_url = '#';
                        if(Auth::guard('user')->check()) {
                            $like_url = "likeProfileMedia('like__media__block__" .$media_detail->id ."', " . $media_detail->id .", '". $tbl ."')";
                        }
                    ?>
                    {{-- likeProfileMedia --}}
                    <div class="like__media__block__{{$media_detail->id}}" onclick="{{ $like_url }}">
                        <?php $likes = explode(',', $media_detail->likes); ?>
                        
                        <i class="fa fa-{{ Auth::guard('user')->check() ? ((array_search(Auth::guard('user')->user()->id, $likes) !== false) ? 'heart red-heart' : 'heart-o' ) : 'heart-o'}} media__fill__like" aria-hidden="true"></i>
                        <span class="media__like__count">{{ empty($media_detail->likes) ? 0 : count($likes) }}</span>
                    </div>
                </div>
                <div class="col-md-2 comment_profile">
                    <div class="dropdown">
                        <?php $user_profiles = \General::getUserProfiles(Auth::guard('user')->user()->id); ?>
                        <div class="dropdown-flex">
                            <img src="{{ asset('/')}}uploads/profile_picture/{{ $user_profiles[0]->profile_pic }}" class="dropdown-image">
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </div>
                        <div class="dropdown-content active__profile">
                            @foreach ($user_profiles as $key => $value)
                                <a href="javascript:void(0)" class="users__profiles {{ $key == 0 ? 'active' : '' }}" data-media="{{ $media_detail->id }}" data-name="{{ $value->full_name }}" data-id="{{$value->users_profiles_id}}" data-img="{{ asset('/')}}uploads/profile_picture/{{$value->profile_pic}}">{{$value->profile_name}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="comment__section">
                <?php echo $comments ?>
            </div>
        </div>
    </div>
</div>

{!! Form::open(array('method' => 'post', 'route' => 'delete.media', 'class' => 'form', 'id' => 'delete__media', 'files'=>true)) !!}
    <input type="hidden" id="media_id" name="media_id">
    <input type="hidden" id="tbl" name="tbl">
{!! Form::close() !!}

<script>

    $(document).on('click','.do_full_screen', function(){
        var iframe = document.getElementById('make__fullscreen');
        if (iframe.requestFullscreen) {
            iframe.requestFullscreen();
        } else if (iframe.webkitRequestFullscreen) { /* Safari */
            iframe.webkitRequestFullscreen();
        } else if (iframe.msRequestFullscreen) { /* IE11 */
            iframe.msRequestFullscreen();
        }
    });

</script>


<script>
    $('.media_tagged_user').select2({
        templateSelection: function(state, container) {
            if (!state.id) {
                return state.text;
            }

            var $option = $('.media_tagged_user option[value="'+state.id+'"]');
            
            
            route = "{{ asset('/') }}main-profile/"+$option.attr('data-handlename');
            var $state = $(
                '<span> <a href="'+route+'" target="_blank" class="clear_css"><span></span></a></span>'
            );

            // Use .text() instead of HTML string concatenation to avoid script injection issues
            $state.find("span").text(state.text);

            
            // $.ajax({
            //     method: "get",
            //     data: {handle_name: state.text},
            //     success: function(response) {
            //         console.log(response);
            //         $state.find("a").attr("href", response);
            //     }
            // });
            
            // var $option = $('.select2 option[value="'+state.id+'"]');
            // if ($option.attr('locked')){
            //     $(container).addClass('locked-tag');
            //     state.locked = true; 
            // }

            return $state;
        }
    });
    function deleteProfileMedia(media_id, tbl) {
        if(confirm('Are you sure you want to delete media?')) {
            $('#delete__media').find('#media_id').val(media_id);
            $('#delete__media').find('#tbl').val(tbl);
            $('#delete__media').submit();
        }
    }
        
    function archiveMedia(media_id, status, tbl) {
        $.ajax({
            url: "{{ route('archive.profile.media') }}",
            type: 'post',
            data: {_token: '{{ csrf_token() }}', tbl: tbl, media_id: media_id, status: status },
            success:function(response) {
                location.reload(true);
            }
        });
    }

    function likeProfileMedia(element, media_id, tbl) {
        $.ajax({
            url: "{{ route('like.media') }}",
            type: 'post',
            data: {_token: '{{ csrf_token() }}', tbl: tbl, media_id: media_id, profile_id: '{{$profile_id}}', user: '{{ $user_profile_id}}'},
            success:function(response) {
                var likes = $('.' + element).find('.media__like__count').text();
                $('.' + element).find('.media__fill__like').toggleClass('red-heart');
                
                if(response == "false") {
                    $('.' + element).find('.media__like__count').html((parseInt(likes) - 1));
                } else {
                    $('.' + element).find('.media__like__count').html((parseInt(likes) + 1));
                }
                if(!$('.' + element).find('.media__fill__like').hasClass('red-heart')) {
                    $('.' + element).find('.media__fill__like').removeClass('fa-heart');
                    $('.' + element).find('.media__fill__like').addClass('fa-heart-o');
                } else {
                    $('.' + element).find('.media__fill__like').addClass('fa-heart');
                    $('.' + element).find('.media__fill__like').removeClass('fa-heart-o');
                }
            }
        });
    }

    $(document).on('change', '#tag_user_ids', function(e) {
        var tbl = $(this).attr('data-tbl');
        var media_id = $(this).attr('data-id');
        var tag_user_ids = $(this).val();

        $.ajax({
            url: "{{ route('update.tagged.user') }}",
            type: 'post',
            data: {_token: '{{ csrf_token() }}', tbl: tbl, media_id: media_id, tag_user_ids: tag_user_ids},
            success:function(response) {
                // console.log(response)
            }
        });
    });

    $(document).on('click', '.edit-text-area', function(){
        jobMode("edit");
    });
    $(document).on('click', '#update__media__desc', function(){
        var dsc = $('#media__description').html();
        var media_id = $(this).attr('data-id');
        var tbl = $(this).attr('data-tbl');
        
        $(this).html('<i class="fa fa-spinner fa-spin"></i>');
        console.log("hello");
        $.ajax({
            url: "{{ route('update.profile.media.description') }}",
            type: "POST",
            data: {_token: '{{ csrf_token() }}', tbl: tbl, media_id: media_id, description: dsc },
            success: function(result){
                $('#display__media__description').html(dsc);
                jobMode("new");
            }
        })
    });

    $(document).on('click', '.fa-close-cancel', function(){
        jobMode("new");
    });

    function jobMode(job) {
        if(job == "edit") {
            $('.text-anchor-tag').hide();
            $('.update-btn').show();
            $('.text-area').show();
            $('.edit-text-area').hide();
            $('.fa-close-cancel').attr('style', 'display:block!important');
            $('#update__media__desc').html('Update');
        } else {
            $('.text-anchor-tag').show();
            $('.edit-text-area').show();
            $('.update-btn').hide();
            $('.text-area').hide();
            $('.fa-close-cancel').hide();
            $('#update__media__desc').html('Update');
        }
    }

    $(document).on('click', '.users__profiles', function(e) { 
        $('.users__profiles').removeClass('active');
        $('.dropdown-image').attr('src', $(this).attr('data-img'));
        $(this).addClass('active');
    });
    
</script>


<script src="{{ asset('/') }}home/js/jquery.tribute.js" ></script>
<script>
    // var init = 1;
    // $(document).ready(function(e) {
    //     if(init == 1) {
    //         $.ajax({
    //             method: "get",
    //             url: routehere,
    //             success: function(data){
    //                 init++;
    //                 initTagTextarea(JSON.parse(data));
    //             }
    //         });
    //     }
    // })
    
    // **Load key people data using ajax call. check above ajax call method**
    initTagTextarea(
        [
            { key: "Phil Heartman", value: "pheartman", link:"http://google.com" },
            { key: "Gordon Ramsey", value: "gramsey", link:"http://google.com" }
    ]);

    function initTagTextarea(keypeople) {
        
        var tribute = new Tribute({
            values: keypeople,
        
            selectTemplate: function(item) {
                if (typeof item === "undefined") return null;
                
                if (this.range.isContentEditable(this.current.element)) {
                    return (
                    '<span contenteditable="false"><a class="tag_user_style" href="'+item.original.link+'" target="_blank" >@' +
                    item.original.key +
                    "</a></span>"
                    );
                }
            
                return "@" + item.original.key;
            },
            requireLeadingSpace: false
        });
        
        if(document.getElementById("media__description")) {
            tribute.attach(document.getElementById("media__description"));
        }
    }
    

    if(document.getElementById("media__location")) {
        autocomplete(document.getElementById("media__location"), "selected__media__location");
    }

</script>