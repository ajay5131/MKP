{!! Form::open(array('method' => 'post', 'class' => 'form', 'id' => 'profile_media_form', 'files'=>true)) !!}
    
    <input type="hidden" name="users_profiles_id" value="{{$user_profile_id}}">
    <input type="hidden" name="users_id" value="{{Auth::guard('user')->user()->id}}">
    <input type="hidden" name="profile_id" value="{{$profile_id}}">
    <input type="hidden" name="media_type" value="image_pdf">
    <input type="hidden" name="media_location" value="0">
    
    <div class=""> <!--d-flex-->
        <div class="col-md-12 text-left help-block">
            <label>@lang('messages.image_pdf')</label>
            <div class=""> <!--file-upload-box -->
                {!! Form::file('media', array('class'=>'form-control p-1', 'id' => 'media_selected', 'accept' => 'image/jpg,image/jpeg,image/png,application/pdf', 'data-validate' => 'required')) !!} <!--file-upload-->
            </div>
        </div>
        <div class="col-md-6 d-grid">
            <span id="selected_media_image"></span> <!--myImg-->
        </div>
    </div>

    <div class="d-flex py-4">
        <div class="col-md-12 text-left">
            <label>@lang('messages.description')</label>
            {!! Form::textarea('description', null, array('class'=>'form-control custom-h', 'autocomplete' => 'off', 'id'=>'display_left_char', 'rows'=>'3',  'data-validate' =>'max:200',)) !!}
        </div>
    </div>
    <div class="d-flex pt-4">
        <div class="col-md-12">
            <button type="button" id="profile_media_submit" class="btn bg-btn-color btn-color-w btn-lg btn-block">@lang('messages.save')</button>
        </div>
    </div>

{!! Form::close() !!}

<script>
    $('#media_selected').change(function(){
        if ($(this).get(0).files[0]) {
            var extension = $(this).get(0).files[0].name.split('.').pop().toLowerCase()

            if(extension != 'pdf') {
                var reader = new FileReader();
                reader.onload = function () { 
                    $("#selected_media_image").html('<img id="myImg" src="'+ reader.result +'" />');
                };
                
                reader.readAsDataURL($(this).get(0).files[0]); 
            }
        }
    });

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
