
@if(count($media) > 0) 
    @foreach ($media as $key => $value)
        <div>
            
            @switch($value->media_type)
                @case('jpg')
                @case('png')
                @case('jpeg')
                    <img src="{{ asset('/') }}uploads/portofolio/{{ $value->media }}" class="gallery__img overlay__gallery__img" onclick="openModal('media-info-modal', '{{route('load.media', ['media_id' => $value->id, 'user_profile_id' => $user_profile_id, 'profile_id' => $profile_id, 'tbl' => 'UsersProfileMedia'])}}')">
                    
                    @break
                @case('mp4')
                    <div class="overlay__gallery__img height-300 position-absolute w-100 max-width-500" onclick="openModal('media-info-modal', '{{route('load.media', ['media_id' => $value->id, 'user_profile_id' => $user_profile_id, 'profile_id' => $profile_id, 'tbl' => 'UsersProfileMedia'])}}')" ></div>    
                    <video src="{{ asset('/') }}uploads/portofolio/{{ $value->media }}" class="gallery__img height-300" autobuffer autoloop loop controls></video>
                    @break
                @case('pdf')
                    <div class="overlay__gallery__img height-400 position-absolute w-100 max-width-500" onclick="openModal('media-info-modal', '{{route('load.media', ['media_id' => $value->id, 'user_profile_id' => $user_profile_id, 'profile_id' => $profile_id, 'tbl' => 'UsersProfileMedia'])}}')"></div>    
                    <iframe class="gallery__img height-400 position-relative" src="{{ asset('/') }}uploads/portofolio/{{ $value->media }}#view=fit" scrolling="auto"  frameborder="0"  embedded="true"></iframe>
                    @break
                @case('youtube_vimeo')
                    <?php 
                    $src = '';
                    if (strpos($value->media, 'youtube.') !== false) {
                        $youtube_id = substr($value->media, strpos($value->media, "=") + 1);
                        $src = 'https://www.youtube.com/embed/'.$youtube_id.'?controls=1';
                    } else {
                        try{
                            $getValues = file_get_contents('https://vimeo.com/api/oembed.json?url='.$value->media);
                            $jsonObj = json_decode($getValues);
                            preg_match_all("/<iframe[^>]*src=[\"|']([^'\"]+)[\"|'][^>]*>/i", $jsonObj->html, $source );
                            $src = $source[1][0];

                        } catch (Exception $e) {
                        }
                    }
                    ?>
                    <div class="overlay__gallery__img height-300 position-absolute w-100 max-width-500" onclick="openModal('media-info-modal', '{{route('load.media', ['media_id' => $value->id, 'user_profile_id' => $user_profile_id, 'profile_id' => $profile_id, 'tbl' => 'UsersProfileMedia'])}}')"></div>
                    <iframe src="{{ $src }}" loading="lazy" class="gallery__img height-300" frameborder="0" allowtransparency="true" allow="accelerometer; autoplay;encrypted-media; gyroscope;picture-in-picture"></iframe>
                    @break

                @case('soundcloud_spotify')
                    <?php 
                    $src = '';
                    if (strpos($value->media, 'soundcloud.com') !== false) {
                        try{
                            $getValues=file_get_contents('http://soundcloud.com/oembed?format=js&url='.$value->media.'&iframe=true');
                            $decodeiFrame=substr($getValues, 1, -2);
                            $jsonObj = json_decode($decodeiFrame);
                            preg_match_all("/<iframe[^>]*src=[\"|']([^'\"]+)[\"|'][^>]*>/i", $jsonObj->html, $source );
                            $src = $source[1][0];
                        } catch (Exception $e) {

                        }
                    } else {
                        $spotify_split_urls = explode('/', $value->media);
                        $src = "https://open.spotify.com/embed/" . $spotify_split_urls[count($spotify_split_urls)-2] . '/' . $spotify_split_urls[count($spotify_split_urls) - 1];
                    }
                    ?>
                    <div class="overlay__gallery__img height-400 position-absolute w-100 max-width-500" onclick="openModal('media-info-modal', '{{route('load.media', ['media_id' => $value->id, 'user_profile_id' => $user_profile_id, 'profile_id' => $profile_id, 'tbl' => 'UsersProfileMedia'])}}')"></div>
                    <iframe src="{{ $src }}" loading="lazy" class="gallery__img height-400" frameborder="0" allowtransparency="true" allow="accelerometer; autoplay;encrypted-media; gyroscope;picture-in-picture"></iframe>
                    @break;
                    
            @endswitch
        </div>
        
    @endforeach
@endif
