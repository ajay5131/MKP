
@if(count($media) > 0) 
    @foreach ($media as $key => $value)
        <div class="music-box" id="scroll_to_music">
            <div class="row">
                <div class="col-md-2">
                    <img class="img-fluid max-height-190" src="{{ asset('/') }}uploads/portofolio/{{ $value->album_cover }}">
                </div>
                <div class="col-md-6 text-left">
                    <h5><a href="#" class="music-txt">{{ $value->title }}</a></h5>
                    <h6>By <a href="#" class="music-txt">iola</a></h6>
                    
                    <?php 
                        $genres = explode(',', \Config::get('global.genres')); 
                        $music_genres = explode(',', $value->genres);
                        $html = '';
                        if(!empty($value->genres)){
                            foreach ($music_genres as $key1 => $value1) {
                                $html = (empty($html) ? '' : $html .' / ' ) . $genres[$value1];
                            }
                        }
                        
                    ?>
                    @if(!empty($html))
                        <span class="breadcrum-music">

                            <?php echo $html; ?>

                        </span>
                    @endif
                    <div class="audio-player audio-player-{{$value->id}} mt-3" id="{{$value->id}}">
                        <div class="timeline">
                            <div class="progress"></div>
                        </div>
                        <div class="controls">
                            <div class="play-container">
                                <div class="toggle-play play">
                                </div>
                            </div>
                            <div class="time">
                                <div class="current">0:00</div>
                                <div class="divider">/</div>
                                <div class="length"></div>
                            </div>
                            <div class="volume-container">
                                <div class="volume-button">
                                    <div class="volume icono-volumeMedium"></div>
                                </div>
                                
                                <div class="volume-slider">
                                    <div class="volume-percentage"></div>
                                </div>
                            </div>
                            
                            <div class="name">{{ !empty($value->tempo) ? 'BPM: ' . $value->tempo : '' }}</div>
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        <div class="row py-1 a-v-center px-3 py-3 flex-option-end">
                            <div>
                                <div class="dropdown">
                                    <i class="fa fa-share dropbtn" aria-hidden="true"></i>
                                    <span>0</span>
                                    <p class="dropdown-content">
                                        <a href="#" data-toggle="modal" data-target="#to_your_feed">To Your
                                            Feed</a>
                                        <a href="#" data-toggle="modal" data-target="#to_key_people">To Key
                                            People</a>
                                        <a href="#">Copy Link</a>
                                    </p>
                                </div>
                            </div>
                            <div class="play__music__block__{{$value->id}}">
                                <i class="fa fa-play" aria-hidden="true"></i>
                                <span class="play__count">{{ empty($value->audio_play_count) ? 0 : $value->audio_play_count }}</span>
                            </div>
                            <div>
                                <i class="fa fa-comment-o get__comments cursor-pointer" data-tbl="UsersProfileMediaComments" data-id="{{$value->id}}"  aria-hidden="true"></i>
                                <span>0</span>
                            </div>
                            <?php 
                                $like_url = '#';
                                if($can_update) {
                                    $like_url = "likeMedia('like__music__block__" .$value->id ."', " . $value->id .")";
                                }
                            ?>
                            <div class="like__music__block__{{$value->id}}" onclick="{{ $like_url }}">
                                <?php $likes = explode(',', $value->likes); ?>
                                
                                <i class="fa fa-{{ Auth::guard('user')->check() ? ((array_search(Auth::guard('user')->user()->id, $likes) !== false) ? 'heart red-heart' : 'heart-o' ) : 'heart-o'}} fill__like " aria-hidden="true"></i>
                                <span class="like__count">{{ empty($value->likes) ? 0 : count($likes) }}</span>
                            </div>

                            <div class="comment_profile px-0" id="comment_profile_{{$value->id}}">
                                <div class="dropdown px-0">
                                    <?php $user_profiles = \General::getUserProfiles(Auth::guard('user')->user()->id); ?>
                                    <div class="dropdown-flex px-0">
                                        <img src="{{ asset('/')}}uploads/profile_picture/{{ $user_profiles[0]->profile_pic }}" class="dropdown-image">
                                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                                    </div>
                                    <div class="dropdown-content px-0">
                                        @foreach ($user_profiles as $key1 => $value1)
                                            <a href="javascript:void(0)" class="users__profiles {{ $key1 == 0 ? 'active' : '' }}" data-media="{{ $value->id }}" data-name="{{ $value1->full_name }}" data-id="{{$value1->users_profiles_id}}" data-img="{{ asset('/')}}uploads/profile_picture/{{$value1->profile_pic}}">{{$value1->profile_name}}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="comment__section comments__block__{{$value->id}}">
                    </div>

                </div>
                <div class="col-md-2">
                    <div class="row flex-column">
                        <?php $click_event = "openModal('add_to_key_list', '". route('add.to.keylist', ['profile_id' => $profile_id, 'user_profile' => $value->id, 'media_type' => 'UsersProfileMedia' ]). "')"; ?>

                        <div class="circle-plus-icon set-margin-center" onclick="{{ $can_update ? $click_event : 'return false' }}">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </div>
                        <p>Add to key list </p>
                    </div>
                    <div class="row">
                        <div class="three-icon-row">
                            @if($can_update)
                                <div onclick="openModal('unlock-llc', '{{route('update.visible', ['tbl' => 'UsersProfileMedia', 'curr_visible' => $value->locked , 'media_id' => $value->id, 'profile_id' => $profile_id, 'user_profile' => $user_profile_id])}}')">
                                    <i class="fa fa-{{ $value->locked <= 1 ? 'unlock' : 'lock' }} unlock-fa-icon" id="lock__{{ $value->id }}" aria-hidden="true"></i>
                                </div>
                                <div onclick="deleteMedia({{$value->id}})">
                                    <i class="fa fa-trash-o delete-fa" aria-hidden="true"></i>
                                </div>
                                <div onclick="openModal('add_music_modal', '{{route('edit.music', ['media_id' => $value->id, 'profile_id' => $profile_id, 'user_profile' => $user_profile_id])}}')">
                                    <i class="fa fa-pencil edit-fa" aria-hidden="true"></i>
                                </div>
                            @endif
                        </div>


                    </div>
                </div>
                <div class="col-md-2">
                    <div class="row">
                        <div class="col-md-12 intrument-area">
                            <p>Instruments:</p>
                            <p>
                                <?php 
                                $instruments = explode(',', \Config::get('global.instruments')); 
                                $music_instruments = explode(',', $value->instruments);
                                $html = '';
                                if(!empty($value->instruments)) {
                                    foreach ($music_instruments as $key1 => $value1) {
                                        $html = (empty($html) ? '' : $html .', ' ) . $instruments[$value1];
                                    }
                                }
                                echo $html;
                                ?>
                            </p>
                        </div>
                        <hr>
                        <div class="col-md-12 keyword-area">
                            <p><strong>Keywords:</strong></p>
                            <p>{{ $value->keywords }}</p>
                        </div>
                    </div>
                </div>
            </div>
        
            <script type="text/javascript">
                const audioPlayer{{$value->id}} = document.querySelector(".audio-player-{{$value->id}}");
                const audio{{$value->id}} = new Audio(
                    "{{ asset('/') }}uploads/portofolio/{{ $value->media }}"
                );
                audioPlayer{{$value->id}}.append(audio{{$value->id}});
                
                
                audio{{$value->id}}.classList.add('audio_tag');
                
                audio{{$value->id}}.addEventListener(
                "loadeddata",
                    () => {
                        audioPlayer{{$value->id}}.querySelector(".time .length").textContent = getTimeCodeFromNum(
                            audio{{$value->id}}.duration
                        );
                        audio{{$value->id}}.volume = .75;
                    }, false
                );
            
                //click on timeline to skip around
                const timeline{{$value->id}} = audioPlayer{{$value->id}}.querySelector(".timeline");
                timeline{{$value->id}}.addEventListener("click", e => {
                    const timelineWidth = window.getComputedStyle(timeline{{$value->id}}).width;
                    const timeToSeek = e.offsetX / parseInt(timelineWidth) * audio{{$value->id}}.duration;
                    audio{{$value->id}}.currentTime = timeToSeek;
                }, false);
            
                //click volume slider to change volume
                const volumeSlider{{$value->id}} = audioPlayer{{$value->id}}.querySelector(".controls .volume-slider");
                volumeSlider{{$value->id}}.addEventListener('click', e => {
                    const sliderWidth = window.getComputedStyle(volumeSlider{{$value->id}}).width;
                    const newVolume = e.offsetX / parseInt(sliderWidth);
                    audio{{$value->id}}.volume = newVolume;
                    audioPlayer{{$value->id}}.querySelector(".controls .volume-percentage").style.width = newVolume * 100 + '%';
                }, false)
            
                //check audio percentage and update time accordingly
                setInterval(() => {
                    const progressBar = audioPlayer{{$value->id}}.querySelector(".progress");
                    progressBar.style.width = audio{{$value->id}}.currentTime / audio{{$value->id}}.duration * 100 + "%";
                    audioPlayer{{$value->id}}.querySelector(".time .current").textContent = getTimeCodeFromNum(
                    audio{{$value->id}}.currentTime
                    );
                }, 500);
            
                //toggle between playing and pausing on button click
                const playBtn{{$value->id}} = audioPlayer{{$value->id}}.querySelector(".controls .toggle-play");
                playBtn{{$value->id}}.addEventListener(
                    "click",
                    () => {
                        var all_audio = document.getElementsByClassName('audio_tag');
                        for (var i = 0; i < all_audio.length; i++) {
                            if({{$value->id}} != all_audio[i].parentNode.id) {
                                all_audio[i].pause();
                                $('#' + all_audio[i].parentNode.id).find('.toggle-play').removeClass("pause");
                                $('#' + all_audio[i].parentNode.id).find('.toggle-play').addClass("play");
                                
                            }
                        }
                        
                        if (audio{{$value->id}}.paused) {
                            playBtn{{$value->id}}.classList.remove("play");
                            playBtn{{$value->id}}.classList.add("pause");
                            audio{{$value->id}}.play();
                            
                            playMediaCount('play__music__block__{{$value->id}}', {{$value->id}});
                        } else {
                            playBtn{{$value->id}}.classList.remove("pause");
                            playBtn{{$value->id}}.classList.add("play");
                            audio{{$value->id}}.pause();
                        }
                    },
                    false
                );
            
                audioPlayer{{$value->id}}.querySelector(".volume-button").addEventListener("click", () => {
                    const volumeEl = (audioPlayer{{$value->id}}).querySelector(".volume-container .volume");
                    audio{{$value->id}}.muted = !audio{{$value->id}}.muted;
                    if (audio{{$value->id}}.muted) {
                        volumeEl.classList.remove("icono-volumeMedium");
                        volumeEl.classList.add("icono-volumeMute");
                    } else {
                        volumeEl.classList.add("icono-volumeMedium");
                        volumeEl.classList.remove("icono-volumeMute");
                    }
                });
            
                //turn 128 seconds into 2:08
                function getTimeCodeFromNum(num) {
                    let seconds = parseInt(num);
                    let minutes = parseInt(seconds / 60);
                    seconds -= minutes * 60;
                    const hours = parseInt(minutes / 60);
                    minutes -= hours * 60;
                
                    if (hours === 0) return `${minutes}:${String(seconds % 60).padStart(2, 0)}`;
                    return `${String(hours).padStart(2, 0)}:${minutes}:${String(
                    seconds % 60
                    ).padStart(2, 0)}`;
                }
            
            </script>
        </div>
          
    @endforeach
@endif

<script>
    $(document).on('click', '.get__comments', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        $(this).toggleClass('open');
        
        $('.comment__section').html("");
        $('.dropdown-content').removeClass('active__profile');
        if($(this).hasClass('open')) {
            
            var tbl = $(this).attr('data-tbl');
            var media_id = $(this).attr('data-id');
            $('.comments__block__' + media_id).html('<i class="fa fa-spinner fa-spin"></i>');
            $('#comment_profile_' + media_id).find('.dropdown-content').addClass('active__profile');

            $.ajax({
                url: "{{ route('get.comments') }}",
                type: 'get',
                data: {'tbl': tbl, 'media_id': media_id, '_token': "{{ csrf_token() }}" },
                success:function(response) {
                    $('.comments__block__' + media_id).html(response);
                    $('.main-chat-row-append').show();
                }
            });

        }

    });

    $(document).on('click', '.users__profiles', function(e) { 
        $('.users__profiles').removeClass('active');
        $(this).parents('.comment_profile').find('.dropdown-image').attr('src', $(this).attr('data-img'));
        $(this).addClass('active');
    });
</script>
