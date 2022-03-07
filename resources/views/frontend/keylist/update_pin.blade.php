{!! Form::open(array('method' => 'post', 'class' => 'form', 'id' => 'pin_media_form', 'files'=>false)) !!}
    
    <input type="hidden" name="list_id" id="list___id" value="{{$list_id}}">

    <div class="modal-body">
        <div class="text-left">
            <label for="">Note</label>
            {!! Form::text('pin', Null, array('class'=>'form-control', 'data-validate' => 'required,max:20', 'autocomplete' => 'off', 'placeholder' => 'Note')) !!}
            <p class="text-danger">add note upto 20 characters</p>
        </div>
        <div class="text-left mt-3">
            <h6 class="themetextColor">Choose background color</h6>
            {!! Form::color('pin_bg_color', Null, array('class'=>'', 'id' => 'favcolor')) !!}
            
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" id="pin_media_btn" class="btn bg-btn-color">@lang('messages.save') </button>
    </div>

{!! Form::close() !!}

<script>
    $(document).on('click', '#pin_media_btn', function(e) {
        e.preventDefault();
        if(validateRegister($('#pin_media_form')) == false){
            return false;
        } else {
        // ajax submit
            var form_data = new FormData(document.getElementById("pin_media_form"));
            var list_id = $('#list___id').val();

            var add_title_btn = $(this);
            
            add_title_btn.attr('disabled', 'disabled');
            add_title_btn.html('<i class="fa fa-spinner fa-spin"></i>');

            $.ajax({
                url: "{{route('save.pin.media')}}",
                type: 'post',
                processData: false,
                contentType: false,
                data: form_data,
                success:function(response) {
                    var res = JSON.parse(response);
                    $('#add_note_Modal').modal('hide');
                    $('.note__' + list_id).html(res.text);
                    $('.note__' + list_id).css({'background-color': res.color});
                    $('.thumb-tack').removeAttr('onclick');
                    $('.thumb-tack').addClass('delete__note');
                    $('.thumb-tack').attr('data-id', list_id);
                    $('.thumb-tack').attr('title', "Delete Note");
                }
            });
        }
    });
</script>