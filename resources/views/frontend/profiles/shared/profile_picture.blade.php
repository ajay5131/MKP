{!! Form::open(array('method' => 'post', 'class' => 'form', 'id' => 'profile_picture_form', 'files'=>true)) !!}
    <input type="hidden" name="profile_id" value="{{$profile_id}}">
    <input type="hidden" name="user" value="{{$user_profile_id}}">

    <div class="modal-body">
        <div class="form-group text-left">
        <label class="modal-label"><strong>@lang('messages.upload_a_picture_profile')</strong></label>
            {!! Form::file('pic', array('class'=>'imageUpload', 'data-max-size' => '1024', 'accept' => 'image/jpg,image/jpeg,image/png', 'data-validate' => 'required', 'id'=>'profile_picture', 'placeholder'=>'Profile picture')) !!}
            <div class='help-block text-danger'><small>Max profile image upload size is 1 MB.</small></div>
            <input type="hidden" name="profile_pic" id="uploadedProfileImage">
        </div>

        <div class="form-group text-left">
            <label class="modal-label"><strong>@lang('messages.description')</strong> </label>
            {!! Form::textarea('description', null, array('class'=>'form-control custom-h', 'maxlength' => 255, 'autocomplete' => 'off', 'id'=>'display_left_char', 'rows'=>'3',  'data-validate' =>'max:200', 'placeholder'=>'Description')) !!}    
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('messages.close')</button>
        <button type="button" id="profile_picture_submit" class="btn bg-btn-color">@lang('messages.save') </button>
    </div>

{!! Form::close() !!}

<script>

    $(document).on('click', '#profile_picture_submit', function(e) {
        e.preventDefault();
        if(validateRegister($('#profile_picture_form')) == false){
            return false;
        } else {
        // ajax submit
            var form_data = new FormData(document.getElementById("profile_picture_form"));

            $('.main-pro-tbl-box').html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                url: "{{ route('update.profile.picture') }}",
                type: 'post',
                processData: false,
                contentType: false,
                data: form_data,
                success:function(response) {
                    console.log(response);
                    $('#update_profile_pic_Modal').modal('hide');
                    $('.my-profile-img').attr('src', response);
                }
            })
        }
    });

    $profile_image_crop = $('#image_demo').croppie({
        enableExif: true,
        viewport: {
            width:278,
            height:370,
            type:'rectacngle' //circle
        },
        boundary:{
            width:378,
            height: 420
        }
    });

    $(document).on('change', '#profile_picture', function(){
        
        var fileInput = $(this);
        var maxSize = fileInput.attr('data-max-size');
        if(fileInput.get(0).files.length){
            var fileSize = fileInput.get(0).files[0].size;
            
            if((fileSize/1024)>maxSize){
                alert('profile picture should not more than ' + (maxSize/1024) + ' MB');
                $('#profile_picture_submit').attr('disabled', 'disabled');
                return false;
            } else {
                $('#profile_picture_submit').removeAttr('disabled');

                var reader = new FileReader();
                reader.onload = function (event) {
                    $profile_image_crop.croppie('bind', {
                        url: event.target.result
                    }).then(function(){
                        console.log('jQuery bind complete');
                    });
                }
                reader.readAsDataURL(this.files[0]);
                $('#uploadprofileimgModal').modal('show');
            }
        }
        
    });

    $('.crop_image').click(function(event){
        $profile_image_crop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function(response){
            $.ajax({
                url:"{{ route('upload.profile.picture') }}",
                type: "POST",
                data:{"_token": "{{ csrf_token() }}", "image": response},
                success:function(data) {
                    res = JSON.parse(data);
                    $('#uploadprofileimgModal').modal('hide');
                    $('#uploadedProfileImage').val(res.img_name);
                }
            });
        })
    });
</script>