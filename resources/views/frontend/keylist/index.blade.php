@extends('frontend.layouts.layout')

@section('content')

    <section class="keylist-begin-section">

        <div class="container-fluid">
            <div class="col-md-12 text-right">
                <span class="add-key-list-txt">Add Key List</span> 
                <i class="fa fa-plus plus-circle-2" aria-hidden="true" onclick="openModal('add_key_list_modal', '{{route('add.keylist.title')}}')"></i>
            </div>
        </div>
    </section>


    <section class="keylist-first-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills mb-3 center-tabs" id="pills-tab" role="tablist">
                        @foreach ($keylist_title as $key => $value)

                            <li class="nav-item keylist-tabs" role="presentation" style="border-color:{{$value->color}}">
                                <a class="nav-link key__list__tab {{$key == 0 ? 'active' : ''}}" data-id="{{$value->id}}" id="key-list{{$value->id}}" data-toggle="pill" href="#key_list_{{$value->id}}" role="tab" aria-controls="key_list_{{$value->id}}" aria-selected="true">{{$value->title}} 
                                    
                                    @if(Auth::guard('user')->user()->id == $value->users_id)
                                        <i class="fa fa-pencil hover-show" aria-hidden="true" onclick="openModal('add_key_list_modal', '{{route('edit.keylist.title', ['list_id' => $value->id])}}')"></i>
                                    @endif
                                </a>
                            </li>
                            
                        @endforeach
                    </ul>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12 py-4">
                    <div class="tab-content" id="pills-tabContent">
                        @foreach ($keylist_title as $key => $value)
                            <div class="tab-pane fade show {{$key == 0 ? 'active' : ''}}" id="key_list_{{$value->id}}" role="tabpanel" aria-labelledby="key-list{{$value->id}}">
                                <div class="row">
                                    <div class="container-fluid">
                                        <div class="col-md-12 text-center py-4">
                                            <h3>{{$value->title}}</h3>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12 text-center center-align-button">
                                        <div>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle share-list-btn" type="button"
                                                    id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Share List <i class="fa fa-share" aria-hidden="true"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                    <button class="dropdown-item" type="button" data-toggle="modal"
                                                        data-target="#to_your_feed">To Feed </button>
                                                    <button class="dropdown-item" type="button" data-toggle="modal"
                                                        data-target="#to_key_people">To Key People</button>
                                                    <button class="dropdown-item" type="button">Copy Link</button>
                                                </div>
                                            </div>
                                        </div>
                                        @if(Auth::guard('user')->user()->id == $value->users_id)
                                            <div>
                                                <button type="buttton" class="delete-list" data-id="{{$value->id}}">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i> Delete List</button>
                                            </div>

                                            <div>
                                                <button type="button" class="add-url" data-toggle="modal"
                                                    data-target="#add_url"><i class="fa fa-link" aria-hidden="true"></i>
                                                    Add URL</button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                @if(!empty($keylist[$value->id]))
                                
                                    <div class="container-fluid">
                                        <div class="row pt-5">
                                            @foreach ($keylist[$value->id] as $key_list => $value_list)
                                                <?php $media_detail = $value_list->getMediaDetail(); ?>
                                        

                                                @switch($value_list->media_tbl)
                                                    @case('UsersProfile')
                                                    @case('UsersProfilePicture')
                                                    @case('KeyPeoples')

                                                        <?php 
                                                            $user_profile_detail = $media_detail;
                                                            if($value_list->media_tbl == "UsersProfilePicture" || $value_list->media_tbl == "KeyPeoples") {
                                                                $user_profile_detail = $media_detail->usersProfile;
                                                            }
                                                        ?>
                                                        @if(!empty($user_profile_detail))
                                                            <div class="col-md-3">
                                                                <div class="card card-custom">
                                                                    @if(Auth::guard('user')->user()->id == $value->users_id)
                                                                        <i class="fa fa-minus-circle minus-circle delete-list-media" aria-hidden="true" data-id="{{$value_list->id}}"></i>
                                                                            @if(!empty($value_list->pin)) 
                                                                                <i class="fa fa-thumb-tack thumb-tack delete__note" title="Delete Note" aria-hidden="true" data-id="{{$value_list->id}}" ></i>
                                                                            @else
                                                                                <i class="fa fa-thumb-tack thumb-tack" title="Add Note" aria-hidden="true" onclick="openModal('add_note_Modal', '{{route('add.pin.media', ['list_id' => $value_list->id])}}')" ></i>
                                                                            @endif
                                                                    @endif
                                                                    <span class="note__span note__{{$value_list->id}}" style="background-color: {{$value_list->pin_bg_color}}" >{{ $value_list->pin }}</span>

                                                                    <?php 
                                                                        $route = Config::get('global.profile_routes')[$user_profile_detail->profile_id];
                                                                        $url = route($route, [$user_profile_detail->handle_name]);
                                                                        if($value_list->media_tbl == "UsersProfilePicture") {
                                                                            $url = route($route, [$user_profile_detail->handle_name, 'open' => "picture" ]);
                                                                        }
                                                                    ?>
                                                                    <a href="{{$url}}" class="clear_css" target="_blank">
                                                                        @if($value_list->media_tbl == "KeyPeoples")
                                                                            <img src="{{$user_profile_detail->image_path}}" class="card-img-top card-img-b-radius">
                                                                        @else
                                                                            <img src="{{$media_detail->image_path}}" class="card-img-top card-img-b-radius">
                                                                        @endif
                                                                        <div class="card-body card-custom-body">
                                                                            <div class="card-p-line">
                                                                                <p class="card-text">{{$user_profile_detail->full_name}} ({{$user_profile_detail->gender == "Male" ? 'M' : ($user_profile_detail->gender == "Female" ? 'F' : 'Nby')}}, {{ $user_profile_detail->age() }})</p>
                                                                                <p class="theme-star">{{ $user_profile_detail->getProfile('title') }}</p>
                                                                                <p class="flex-side-by-side">
                                                                                    <span><i class="fa fa-file-text-o" aria-hidden="true"></i> Review
                                                                                        <?php 
                                                                                            $rating = \General::ratingReview($user_profile_detail->id);
                                                                                            if($rating > 0) {
                                                                                                echo '<i class="fa fa-star theme-bg"></i> ' . $rating; 
                                                                                            }
                                                                                        ?>
                                                                                    </span>
                                                                                    <span>{{ \General::countReview($user_profile_detail->id) }}</span>
                                                                                </p>
                                                                                <p class="flex-side-by-side">
                                                                                    <span><i class="fa fa-file-text-o" aria-hidden="true"></i>
                                                                                        Contributions</span>
                                                                                    <span>0</span>
                                                                                </p>
                                                                                <p class="flex-side-by-side">
                                                                                    <span><i class="fa fa-file-text-o" aria-hidden="true"></i> MKP Score
                                                                                    </span>
                                                                                    <span>0</span>
                                                                                </p>
                                                                            </div>
                                                                        </div>

                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        @break


                                                    @case('UsersProfileMedia')
                                                        
                                                        <div class="col-md-3">
                                                            <div class="card card-custom">
                                                                @if(Auth::guard('user')->user()->id == $value->users_id)
                                                                    <i class="fa fa-minus-circle minus-circle delete-list-media" aria-hidden="true" data-id="{{$value_list->id}}"></i>
                                                                    <i class="fa fa-thumb-tack thumb-tack" aria-hidden="true" onclick="openModal('add_note_Modal', '{{route('add.pin.media', ['list_id' => $value_list->id])}}')"></i>
                                                                @endif

                                                                <span class="note__span" style="background-color: {{$value_list->pin_bg_color}}" >{{ $value_list->pin }}</span>

                                                                <?php 
                                                                    $route = Config::get('global.profile_routes')[$media_detail->usersProfile->profile_id];

                                                                    $url = route($route, [$media_detail->usersProfile->handle_name, 'open' => "media", 'media' => $media_detail->id]);
                                                                    if($media_detail->media_type == 'mp3') {
                                                                        $url = route($route, [$media_detail->usersProfile->handle_name, 'open' => "music"]);
                                                                    }
                                                                ?>
                                                                <a href="{{$url}}" class="card__overlay clear_css" target="_blank"></a>
                                                                        
                                                                @switch($media_detail->media_type)
                                                                    @case('jpg')
                                                                    @case('png')
                                                                    @case('jpeg')
                                                                    @case('mp3')

                                                                        @if($media_detail->media_type == "mp3")
                                                                            <img src="{{ asset('/') }}uploads/portofolio/{{ $media_detail->album_cover }}" class="card-img-top card-img-b-radius" >
                                                                        @else
                                                                            <img src="{{ asset('/') }}uploads/portofolio/{{ $media_detail->media }}" class="card-img-top card-img-b-radius" >
                                                                        @endif
                                                                        
                                                                        @break
                                                                    @case('mp4')
                                                                        <video src="{{ asset('/') }}uploads/portofolio/{{ $media_detail->media }}" class="card-img-top card-img-b-radius ob-fit-cover" autobuffer autoloop loop controls></video>
                                                                        @break
                                                                    @case('pdf')
                                                                        <iframe class="card-img-top card-img-b-radius" src="{{ asset('/') }}uploads/portofolio/{{ $media_detail->media }}#view=fit" scrolling="auto"  frameborder="0"  embedded="true"></iframe>
                                                                        @break
                                                                    @case('youtube_vimeo')
                                                                        <?php 
                                                                        $src = '';
                                                                        if (strpos($media_detail->media, 'youtube.') !== false) {
                                                                            $youtube_id = substr($media_detail->media, strpos($media_detail->media, "=") + 1);
                                                                            $src = 'https://www.youtube.com/embed/'.$youtube_id.'?controls=1';
                                                                        } else {
                                                                            try{
                                                                                $getValues = file_get_contents('https://vimeo.com/api/oembed.json?url='.$media_detail->media);
                                                                                $jsonObj = json_decode($getValues);
                                                                                preg_match_all("/<iframe[^>]*src=[\"|']([^'\"]+)[\"|'][^>]*>/i", $jsonObj->html, $source );
                                                                                $src = $source[1][0];
                                                    
                                                                            } catch (Exception $e) {
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <iframe src="{{ $src }}" loading="lazy" class="card-img-top card-img-b-radius" frameborder="0" allowtransparency="true" allow="accelerometer; autoplay;encrypted-media; gyroscope;picture-in-picture"></iframe>
                                                                        @break
                                                    
                                                                    @case('soundcloud_spotify')
                                                                        <?php 
                                                                        $src = '';
                                                                        if (strpos($media_detail->media, 'soundcloud.com') !== false) {
                                                                            try{
                                                                                $getValues=file_get_contents('http://soundcloud.com/oembed?format=js&url='.$media_detail->media.'&iframe=true');
                                                                                $decodeiFrame=substr($getValues, 1, -2);
                                                                                $jsonObj = json_decode($decodeiFrame);
                                                                                preg_match_all("/<iframe[^>]*src=[\"|']([^'\"]+)[\"|'][^>]*>/i", $jsonObj->html, $source );
                                                                                $src = $source[1][0];
                                                                            } catch (Exception $e) {
                                                    
                                                                            }
                                                                        } else {
                                                                            $spotify_split_urls = explode('/', $media_detail->media);
                                                                            $src = "https://open.spotify.com/embed/" . $spotify_split_urls[count($spotify_split_urls)-2] . '/' . $spotify_split_urls[count($spotify_split_urls) - 1];
                                                                        }
                                                                        ?>
                                                                        <iframe src="{{ $src }}" loading="lazy" class="card-img-top card-img-b-radius" frameborder="0" allowtransparency="true" allow="accelerometer; autoplay;encrypted-media; gyroscope;picture-in-picture"></iframe>
                                                                        @break;
                                                                        
                                                                @endswitch
                                                                

                                                                <div class="card-body card-custom-body">
                                                                    <h5 class="card-title">Posted by <span class="text-bg-color">
                                                                        <?php echo $media_detail->usersProfile->full_name ?></span></h5>
                                                                    <p class="card-text"></p>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>

                                                        @break

                                                    @case('KeylistMedia')

                                                        <?php 
                                                            $embed = new \Embed\Embed();
                                                            $info = $embed->get($value_list->media_url);
                                                            $path = $info->image;
                                                            $title = $info->title ? $info->title : '';
                                                            $description = $info->description ? $info->description : '';

                                                        ?>
                                                        <div class="col-sm-12 col-md-6 col-lg-3">  

                                                            <div class="card card-custom">
                                                                @if(Auth::guard('user')->user()->id == $value->users_id)
                                                                    <i class="fa fa-minus-circle minus-circle delete-list-media" aria-hidden="true" data-id="{{$value_list->id}}"></i>
                                                                    <i class="fa fa-thumb-tack thumb-tack" aria-hidden="true" onclick="openModal('add_note_Modal', '{{route('add.pin.media', ['list_id' => $value_list->id])}}')"></i>
                                                                @endif

                                                                <span class="note__span" style="background-color: {{$value_list->pin_bg_color}}" >{{ $value_list->pin }}</span>
                                                                <a href="{{ $value_list->media_url }}" class="clear_css" target="_blank">
                                                                    <img class="card-img-top card-img-b-radius" src="{{$path}}">
                                                                    <div class="card-body card-custom-body">
                                                                        <h5 class="card-title">{{$title}}</h5>
                                                                        <p class="card-text">{{ substr($description, 0, 150) }}</p>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                    
                                                    
                                                            </div>
                                                        @break;
                                                    
                                                    @case('Project')

                                                        <div class="col-md-3">

                                                            <div class="card card-custom">
                                                                @if(Auth::guard('user')->user()->id == $value->users_id)
                                                                    <i class="fa fa-minus-circle minus-circle delete-list-media" aria-hidden="true" data-id="{{$value_list->id}}"></i>
                                                                    <i class="fa fa-thumb-tack thumb-tack" aria-hidden="true" data-toggle="modal">
                                                                @endif

                                                                <span class="note__span" style="background-color: {{$value_list->pin_bg_color}}" >{{ $value_list->pin }}</span>

                                                                    data-target="#add_note_Modal"></i>
                                                                <img src="https://www.meetkeypeople.com/jobsportal/public/images/register/1624389420.png"
                                                                    class="card-img-top card-img-b-radius">
                                                                <div class="card-body card-custom-body">
                                                                    <h5 class="card-title text-bg-color">Short Film</h5>
                                                                    <p class="card-text">Loreum Modal</p>
                                                                    <p class="card-text">
                                                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                                        <span>Western Sahara, Bu Jaydur</span>
                                                                    </p>
                                                                </div>
                                                            </div>
        
        
                                                        </div>

                                                        @break
                                                        
                                                @endswitch                                                
                                                
                                            
                                            @endforeach
                                        </div>
                                    </div>
                                @endif


                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>



    </section>

    {!! Form::open(array('method' => 'post', 'class' => 'form', 'id' => 'delete_key_list_form', 'files'=>false)) !!}    
        <input type="hidden" name="list_id" id="list__id" >
    {!! Form::close() !!}


    @include('frontend.keylist.add_title_modal')
    @include('frontend.keylist.add_pin_modal')
    @include('frontend.keylist.add_url_modal')

    @push('custom-script')

        <script>
            $(document).on('click', '.delete-list', function(e) {

                $('#delete_key_list_form').attr("action", "{{route('delete.keylist')}}")
                $('#list__id').val($(this).attr('data-id'));
                if(confirm('Are you sure you want to delete the list?')) {
                    $('#delete_key_list_form').submit();
                }
            });
            
            $(document).on('click', '.delete-list-media', function(e) {

                $('#delete_key_list_form').attr("action", "{{route('delete.keylist.media')}}")
                $('#list__id').val($(this).attr('data-id'));
                if(confirm('Are you sure you want to delete the media?')) {
                    $('#delete_key_list_form').submit();
                }
            });
            
            $(document).on('click', '.delete__note', function(e) {

                var url = "openModal('add_note_Modal', '{{route('add.pin.media', ['list_id' => $value_list->id])}}')";
                return '<i class="fa fa-thumb-tack thumb-tack" title="Add Note" aria-hidden="true" onclick="'+url+'" ></i>';
            });

        </script>
        
    @endpush

@endsection

