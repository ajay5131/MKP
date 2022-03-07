<div class="modal-body">
    {!! Form::open(array('method' => 'post', 'class' => 'form', 'id' => 'add_key_list_form', 'files'=>true)) !!}
        
        <div class="input-group mb-3 error__block__css">
            <label class="hide" for="">Add New List</label>
            {!! Form::text('title', null, array('class'=>'form-control', 'data-validate' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Add New List')) !!}    
            <div class="input-group-append">
                <button class="btn btn-outline-secondary outline-btn" type="button" id="add_key_list_btn">
                    <i class="fa fa-plus-circle plus-circle" aria-hidden="true"></i>
                </button>
            </div>
            <div class="text-danger custom-error-msg" id="title"></div>
        </div>

    {!! Form::close() !!}


    {!! Form::open(array('method' => 'post', 'class' => 'form', 'id' => 'add_to_key_list_form', 'files'=>true)) !!}
        
        <input type="hidden" name="media_id" value="{{ $media_id }}">
        <input type="hidden" name="media_tbl" value="{{ $media_type }}">

        <div class="list_of_keylist text-left">

            @if(!empty($keylist))

                @foreach ($keylist as $key => $value)
                    
                    <div class="form-check text-left check-field-center">
                        <input class="form-check-input" type="radio" name="keylist_title_id" data-validate="required_radio_any_one" id="keylist_{{ $value->id }}" value="{{ $value->id }}">
                        <label class="form-check-label" for="keylist_{{ $value->id }}">
                            {{ $value->title }}
                        </label>
                    </div>
        
                @endforeach
        
            @endif

        </div>
        <div class="text-right">
            <hr>
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
            <button type="button" class="btn bg-btn-color btn-color-w" id="add_to_key_list_btn">@lang('messages.save')</button>
        </div>

    {!! Form::close() !!}
</div>


<script>
    $(document).on('click', '#add_key_list_btn', function(e) {
        e.preventDefault();
        if(validateRegister($('#add_key_list_form')) == false){
            return false;
        } else {
        // ajax submit
            var form_data = new FormData(document.getElementById("add_key_list_form"));

            var add_title_btn = $(this);
            
            add_title_btn.attr('disabled', 'disabled');
            $('#add_key_list_btn').attr('disabled', 'disabled');
            add_title_btn.html('<i class="fa fa-spinner fa-spin"></i>');
            
            $('#title').html("");

            $.ajax({
                url: "{{ route('add.keylist.title') }}",
                type: 'post',
                processData: false,
                contentType: false,
                data: form_data,
                success:function(response) {

                    var res = JSON.parse(response);
        
                    if (res.result == "true") {
                        $('#add_key_list_form').trigger("reset");
                        $('.list_of_keylist').html(res.keylists);
                    } else {
                        $.each(res, function (index, value) {
                            if (value[0] != '') {
                                $('#' + index).addClass("has-error");
                                $('#' + index).html(value[0]);
                            }
                        });
                    }

                    add_title_btn.removeAttr('disabled');
                    $('#add_key_list_btn').removeAttr('disabled');
                    add_title_btn.html('<i class="fa fa-plus-circle plus-circle" aria-hidden="true"></i>');
                    
                }
            });
        }
    });

    $(document).on('click', '#add_to_key_list_btn', function(e) {
        e.preventDefault();
    
        if(validateRegister($('#add_to_key_list_form')) == false){
            return false;
        } else {
            // ajax submit
            var form_data = new FormData(document.getElementById("add_to_key_list_form"));

            var add_title_btn = $(this);
            
            add_title_btn.attr('disabled', 'disabled');
            add_title_btn.html('<i class="fa fa-spinner fa-spin"></i>');

            $.ajax({
                url: "{{ route('save.to.keylist') }}",
                type: 'post',
                processData: false,
                contentType: false,
                data: form_data,
                success:function(response) {
                    alert("successfully added into keylist!");
                    $('#add_to_key_list').modal('hide');
                }
            });
        }
    });
</script>
