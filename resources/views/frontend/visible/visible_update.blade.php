
{!! Form::open(array('method' => 'post', 'class' => 'form', 'id' => 'visible_form', 'files'=>true)) !!}

    <input type="hidden" name="tbl" value="{{ $tbl }}">
    <input type="hidden" name="media_id" value="{{ $media_id }}">
    <input type="hidden" name="user_profile_id" value="{{ $user_profile_id }}">
    <input type="hidden" name="profile_id" value="{{ $profile_id }}">


    @foreach ($visible as $key => $value)
        
        <div class="row">
            <div class="col-md-11 text-left">
                <span style="font-weight: bold;"><?php echo $value->title ?></span>
                <p><?php echo $value->description ?></p>
            </div>
            <div class="col-md-1">
                <input type="radio" class="visibiltyRadio update__visible" name="locked" {{ $curr_visible == $value->id ? 'checked' : ''}} value="<?php echo $value->id ?>">
            </div>
        </div>

    @endforeach


{!! Form::close() !!}

<script>
    $(document).on('click', '.update__visible', function(e) {
        
        var form_data = new FormData(document.getElementById("visible_form"));
        // var lock = $(this).val();

        $.ajax({
            url: "{{ route('update.visible') }}",
            type: 'post',
            processData: false,
            contentType: false,
            data: form_data,
            success:function(response) {
                
                if(response == 1) {
                    $('#lock__{{$media_id}}').removeClass('fa-lock').addClass('fa-unlock')
                } else {
                    $('#lock__{{$media_id}}').removeClass('fa-unlock').addClass('fa-lock')
                }
            }
        })
    
    });
</script>
