{!! Form::open(array('method' => 'post', 'class' => 'form', 'id' => 'profile_music_form', 'files'=>true)) !!}

    <input type="hidden" name="media_id" value="{{!empty($music) ? $music->id : ''}}">
    <input type="hidden" name="users_profiles_id" value="{{$user_profile_id}}">
    <input type="hidden" name="users_id" value="{{Auth::guard('user')->user()->id}}">
    <input type="hidden" name="profile_id" value="{{$profile_id}}">
    <input type="hidden" name="media_type" id="media_type" value="audio">
    <input type="hidden" name="media_location" value="1">

    <div class="modal-body">
        <div class="d-flex py-2">
            <div class="col-md-12 text-left">
                {!! Form::label('album_cover', \Lang::get('messages.album_cover'), ['class' => 'bold']) !!}

                {!! Form::file('album_cover', array('class'=>'form-control file-choose-p-adjust', 'data-max-size' => '1024', 'accept' => 'image/jpg,image/jpeg,image/png', 'data-validate' => (!empty($music) ? '' : 'required') , 'id'=>'album_cover', 'placeholder'=>'Album cover')) !!}
                <div class='help-block text-danger'><small>Max image upload size is 1 MB.</small></div>            

            </div>
        </div>
        @if(!empty($music))
            <div class="py-2">
                <div class="col-md-3 text-left">
                    <img class="mw-100" src="{{ asset('/')}}uploads/portofolio/{{ $music->album_cover }}" alt="">
                </div>
            </div>
        @endif

        <div class="d-flex py-2">
            <div class="col-md-12 text-left">
                {!! Form::label('mp3', \Lang::get('messages.mp3'), ['class' => 'bold']) !!}
                {!! Form::file('media', array('class'=>'form-control file-choose-p-adjust', 'accept' => 'audio/mp3', 'value' => !empty($music) ? $music->media : '', 'data-validate' => (!empty($music) ? '' : 'required'), 'id'=>'album_media', 'placeholder'=>'Media')) !!}
            </div>
        </div>

        @if(!empty($music))
            <div class="py-2">
                <div class="col-md-12 text-left">
                    <audio controls preload="auto" controlsList="nodownload">
                        <source src="{{ asset('/')}}uploads/portofolio/{{ $music->media }}" type="audio/mp3">
                          Your browser dose not Support the audio Tag
                    </audio>
                </div>
            </div>
        @endif



        <div class="d-flex py-2">
            <div class="col-md-12 text-left">
                {!! Form::label('title', \Lang::get('messages.title'), ['class' => 'bold']) !!}
                {!! Form::text('title', (!empty($music) ? $music->title : '') , array('class'=>'form-control', 'data-validate' =>'required,max:120', 'id'=>'title')) !!}
                
            </div>
        </div>


        <div class="d-flex py-2">
            <div class="col-md-12 text-left">
                {!! Form::label('album_by', \Lang::get('messages.by'), ['class' => 'bold']) !!}
                {!! Form::select('album_by[]', $by, (!empty($music) ? explode(',', $music->album_by) : ''), array('class'=>'form-control select2', 'multiple' => 'multiple', 'data-maximum-selection-length' => '8', 'data-validate' =>'max_selection' )) !!}
            </div>
        </div>

        <div class="d-flex py-2">
            <div class="col-md-12 text-left">
                <?php $genres = explode(',', \Config::get('global.genres')); ?>
                {!! Form::label('genres', \Lang::get('messages.genres'), ['class' => 'bold mb-0']) !!} 
                {!! Form::select('genres[]', $genres, (!empty($music) ? explode(',', $music->genres) : ''), array('class'=>'form-control select2', 'multiple' => 'multiple', 'data-maximum-selection-length' => '8', 'data-validate' =>'max_selection' )) !!}
            </div>
        </div>

        <div class="d-flex py-2">
            <div class="col-md-12 text-left">
                <?php $instruments = explode(',', \Config::get('global.instruments')); ?>
                {!! Form::label('instrument', \Lang::get('messages.instruments'), ['class' => 'bold mb-0']) !!} 
                {!! Form::select('instruments[]', $instruments, (!empty($music) ? explode(',', $music->instruments) : ''), array('class'=>'form-control select2', 'multiple' => 'multiple', 'data-maximum-selection-length' => '8', 'data-validate' =>'max_selection' )) !!}
            </div>
        </div>

        <div class="d-flex py-2">
            <div class="col-md-12 text-left">
                {!! Form::label('tempo', \Lang::get('messages.tempo'), ['class' => 'bold']) !!}
                {!! Form::number('tempo', (!empty($music) ? $music->tempo : '') , array('class'=>'form-control', 'maxlength' => 3, 'data-validate' =>'numeric,max:3', 'id'=>'tempo')) !!}
            </div>
        </div>

        <div class="d-flex py-2">
            <div class="col-md-8 text-left">
                {!! Form::label('keywords_lyrics', \Lang::get('messages.keywords_lyrics'), ['class' => 'bold']) !!}
            </div>
            <div class="col-md-4 text-left">
                <button type="button" onclick="addMore()" class="btn bg-btn-color btn-color-w">@lang('messages.add') @lang('messages.keyword')</button>
            </div>
        </div>

        <div class="add_more_keyword" data-index="{{ empty($music->keywords) ? '1' : count(explode(',', $music->keywords)) }}">
            @if(empty($music->keywords)) 
                <div class="d-flex py-2 keyword_1">
                    <div class="col-md-6 text-left">
                        {!! Form::text('keywords[]', null , array('class'=>'form-control', 'autocomplete' => 'off', 'maxlength' => 10, 'data-validate' =>'alphaspacenumeric,max:10')) !!}
                    </div>
                    {{-- <div class="col-md-6 text-left">
                        <i class="fa fa-trash-o delete-icon" aria-hidden="true"></i>
                    </div> --}}
                </div>
            @else
                <?php $keywords = explode(',', $music->keywords); ?>
                @foreach ($keywords as $index => $item)
                    <div class="d-flex py-2 keyword_1 {{ $index != 0 ? 'add_more_class' : ''}}">
                        <div class="col-md-6 text-left">
                            {!! Form::text('keywords[]', $item , array('class'=>'form-control', 'autocomplete' => 'off', 'maxlength' => 10, 'data-validate' =>'alphaspacenumeric,max:10')) !!}
                        </div>
                        @if($index != 0)
                            <div class="col-md-6 text-left">
                                <i class="fa fa-trash-o delete-icon delete_block" aria-hidden="true"></i>
                            </div>
                        @endif
                    </div>
                @endforeach
                
            @endif

        </div>
        
        <div class="add_more_html hide">
            <div class="d-flex py-2 add_more_class">
                <div class="col-md-6 text-left">
                    {!! Form::text('keywords[]', null , array('class'=>'form-control', 'autocomplete' => 'off', 'maxlength' => 10, 'data-validate' =>'alphaspacenumeric,max:10')) !!}
                </div>
                <div class="col-md-6 text-left">
                    <i class="fa fa-trash-o delete-icon delete_block" aria-hidden="true"></i>
                </div>
            </div>
        </div>

        <div class="d-flex py-2">
            <div class="col-md-12 text-left">
                {!! Form::label('visible_to', \Lang::get('messages.visible_to'), ['class' => 'bold mb-0']) !!} 
                {!! Form::select('locked', [1 => 'Public', 2 => 'Private', 3 => 'Secret', 4 => 'VIP'], (!empty($music) ? explode(',', $music->locked) : ''), array('class'=>'form-control' )) !!}
                
            </div>
        </div>

        <div class="d-flex py-2">
            <div class="col-md-12 text-left download-mkp-radio-checkfiled">
                <input type="checkbox" name="downloadable_only_mkp_radio" value="1" class="checkbox-w-h">
                <label class="mb-0 pl-10"> @lang('messages.downloadable_only_for_mkp_radio')</label>
            </div>
        </div>


    </div>
    <div class="modal-footer">
        <button type="button" id="profile_music_submit" class="btn bg-btn-color btn-color-w btn-lg btn-block">@lang('messages.save')</button>
    </div>

{!! Form::close() !!}


<script>
    $('.select2').select2();

    $(document).on('click', '#profile_music_submit', function(e) {
        e.preventDefault();
        if(validateRegister($('#profile_music_form')) == false) {
            return false;
        } else {
            var formData = new FormData(document.getElementById("profile_music_form"));
            var submit_btn = $(this);
            submit_btn.attr('disabled', 'disabled');
            
            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = ((evt.loaded / evt.total) * 100);
                            $(".percentage").html(Math.round(percentComplete)+'%');
                        }
                    }, false);
                    return xhr;
                },
                type: 'POST',
                url: $('#profile_music_form').attr('action'),
                data: formData,
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function(){
                    $('#loader').show();
                    $(".percentage").html('0%');
                },
                error:function(err){
                    alert("File upload failed, please try again.");
                    location.reload(true);
                },
                success: function(resp){
                    if(resp == "success") {
                        location.reload(true);
                    } else {
                        alert("File upload failed, please try again.");
                        location.reload(true);
                    }
                }
            });
            // $('#profile_music_form').submit();
        }
    });
</script>

