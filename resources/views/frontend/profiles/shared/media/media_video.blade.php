{!! Form::open(array('method' => 'post', 'class' => 'form', 'id' => 'profile_media_form', 'files'=>true)) !!}
    
    <input type="hidden" name="users_profiles_id" value="{{$user_profile_id}}">
    <input type="hidden" name="users_id" value="{{Auth::guard('user')->user()->id}}">
    <input type="hidden" name="profile_id" value="{{$profile_id}}">
    <input type="hidden" name="media_type" id="media_type" value="video">
    <input type="hidden" name="media_location" value="0">

    <div class="d-flex py-2">
        <div class="col-md-12 text-left checkbox-field">
            <input type="checkbox" class="add_vedio_checkbox" id="checkboxChecked" onClick="CheckedCheckbox()">
            <label for="check-label">@lang('messages.youtube_vimeo') @lang('messages.video')</label>
        </div>
    </div>

    <div class="d-flex py-2 hide remove_hide" >
        <div class="col-md-12 text-left hide" id="input_youtube_video">
            <label><strong>@lang('messages.url') (@lang('messages.youtube_vimeo'))</strong></label>
            {!! Form::url('media', null, array('class'=>'form-control mb-15', 'maxlength' => '255', 'data-validate' => 'required,url,match_any_one:youtube./vimeo.', 'id' => 'youtube_vimeo',  'autocomplete' => 'off')) !!}
        </div>
    </div>

    <div class="py-2 remove_hide" >
        <div class="col-md-12 text-left" id="upload-hide-show-control">
            <label><strong>@lang('messages.upload')</strong></label>
            {!! Form::file('media', array('class'=>'form-control p-1', 'id' => 'media_selected', 'accept' => 'video/mp4', 'data-validate' => 'required')) !!}
            <span class="txt-color-red w-100 d-block">@lang('messages.upload_video_less_than_60_second')</span>
        </div>
        <div class="col-md-12">
            <span id="selected_media_image"></span>
        </div>
    </div>

    <div class="d-flex py-2">
        <div class="col-md-12 text-left">
            <label><strong>@lang('messages.description')</strong></label>
            {!! Form::textarea('description', null, array('class'=>'form-control custom-h', 'autocomplete' => 'off', 'id'=>'display_left_char', 'rows'=>'3',  'data-validate' =>'max:200',)) !!}
        </div>
    </div>

    <div class="col-md-12">
        <button type="button" id="profile_media_submit" class="btn bg-btn-color btn-color-w btn-lg btn-block">@lang('messages.save')</button>
    </div>

{!! Form::close() !!}

<script>
    function CheckedCheckbox(){
        $('#selected_media_image').html("");
        $('#youtube_vimeo').val("");
        $('#media_selected').val("");
        
        if ($('#checkboxChecked:checked').val() !== undefined) {
            $('#media_type').val('youtube_vimeo');
            $('.remove_hide').toggleClass('hide');
            $('#input_youtube_video').removeClass('hide');
            $('#upload-hide-show-control').addClass('hide');
        } else {
            $('#media_type').val('video');
            $('#input_youtube_video').addClass('hide');
            $('.remove_hide').toggleClass('hide');
            $('#upload-hide-show-control').removeClass('hide');
        }
    }

    $('#media_selected').change(function(){
        if ($(this).get(0).files[0]) {
            var reader = new FileReader();
            reader.onload = function () { 
                $("#selected_media_image").html('<video id="myImg" class="hide" controls><source  id="video_here" src="'+ reader.result +'" ></video>');
                validateVideoLength();
            };
            reader.readAsDataURL($(this).get(0).files[0]); 
        }
    });

    function validateVideoLength() {
        var $source = $('#video_here');
        $source[0].src = URL.createObjectURL(document.getElementById('media_selected').files[0]);
        $source.parent()[0].load();
        
        setTimeout(() => {
            if(Math.round($source.parent()[0].duration) > 60) {
                alert('Can not upload video more than 60 seconds!');
                $('#profile_media_submit').attr('disabled', 'disabled');
            } else {
                $('#profile_media_submit').removeAttr('disabled');
                $('#myImg').removeClass("hide")
            }
        }, 100);
    }

    $(document).on('click', '#profile_media_submit', function(e) {
        e.preventDefault();
        if(validateRegister($('#profile_media_form')) == false){
            return false;
        } else {
            var formData = new FormData(document.getElementById("profile_media_form"));
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
                url: "{{  route('update.profile.media') }}",
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
            // $("#profile_media_form").submit();
        }
    });
</script>
