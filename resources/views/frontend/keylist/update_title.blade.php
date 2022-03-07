{!! Form::open(array('method' => 'post', 'class' => 'form', 'id' => 'add_key_list_form', 'files'=>false)) !!}
    
    @if(!empty($keylist_title))
        <input type="hidden" name="list_id" value="{{ $keylist_title->id }}">
    @endif

    <div class="modal-header">
        <h5 class="modal-title themetextColor" id="updateprofilepicModalLabel">
            @if(!isset($keylist_title))
                @lang('messages.add') @lang('messages.new') 
            @endif
        
            @lang('messages.key_list')
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">
        <div class="text-left">
            {!! Form::text('title', (!empty($keylist_title) ? $keylist_title->title : Null), array('class'=>'form-control', 'data-validate' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Add New List')) !!}
            <div class="text-danger custom-error-msg" id="title"></div>
        </div>
        <div class="text-left mt-3">
            <h6 class="themetextColor">Choose background color</h6>
            {!! Form::color('color', (!empty($keylist_title) ? $keylist_title->color : Null), array('class'=>'', 'id' => 'favcolor')) !!}
            
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" id="add_key_list_btn" class="btn bg-btn-color btn-lg btn-block">Save</button>
    </div>
{!! Form::close() !!}


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
            add_title_btn.html('<i class="fa fa-spinner fa-spin"></i>');

            $.ajax({
                url: $('#add_key_list_form').attr('action'),
                type: 'post',
                processData: false,
                contentType: false,
                data: form_data,
                success:function(response) {

                    var res = JSON.parse(response);
        
                    if (res.result == "true") {
                        location.reload(true);
                    } else {
                        $.each(res, function (index, value) {
                            if (value[0] != '') {
                                $('#' + index).addClass("has-error");
                                $('#' + index).html(value[0]);
                            }
                        });
                    }

                    add_title_btn.removeAttr('disabled');
                    add_title_btn.html('Save');                    
                }
            });
        }
    });
</script>