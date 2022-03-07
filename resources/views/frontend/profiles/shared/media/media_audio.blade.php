{!! Form::open(array('method' => 'post', 'class' => 'form', 'id' => 'profile_media_form', 'files'=>true)) !!}
    
    <input type="hidden" name="users_profiles_id" value="{{$user_profile_id}}">
    <input type="hidden" name="users_id" value="{{Auth::guard('user')->user()->id}}">
    <input type="hidden" name="profile_id" value="{{$profile_id}}">
    <input type="hidden" name="media_type" id="media_type" value="soundcloud_spotify">
    <input type="hidden" name="media_location" value="0">

    <div class="d-flex py-2">
        <div class="col-md-12 text-left">
            <label>@lang('messages.add') @lang('messages.url')</label>
            {!! Form::url('media', null, array('class'=>'form-control mb-15', 'maxlength' => '255', 'data-validate' => 'required,url,match_any_one:soundcloud./spotify.', 'autocomplete' => 'off')) !!}
        </div>
    </div>
    <div class="d-flex py-2">
        <div class="col-md-12 text-left">
            <label>@lang('messages.description')</label>
            {!! Form::textarea('description', null, array('class'=>'form-control custom-h', 'autocomplete' => 'off', 'id'=>'display_left_char', 'rows'=>'3',  'data-validate' =>'max:200',)) !!}
        </div>
    </div>
    <div class="col-md-12">
        <button type="button" id="profile_media_submit" class="btn bg-btn-color btn-color-w btn-lg btn-block">@lang('messages.save')</button>
    </div>


{!! Form::close() !!}

<script>
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
