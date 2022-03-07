<div class="modal fade" id="add_url" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title themetextColor" id="updateprofilepicModalLabel">Add URL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(array('method' => 'post', 'class' => 'form', 'id' => 'add_keylist_url_form', 'files'=>false)) !!}
                <input type="hidden" name="media_tbl" value="KeylistMedia">
                <input type="hidden" name="keylist_title_id" id="keylist_title_id">
                <div class="modal-body">
                    <div class="text-left help-block">
                        <label for="">URL</label>
                        {!! Form::url('media_url', Null, array('class'=>'form-control', 'data-validate' => 'required,url', 'autocomplete' => 'off', 'placeholder' => 'URL')) !!}
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" id="add_keylist_url_btn" class="btn bg-btn-color">Save</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@push('custom-script')
    <script>
        $(document).on('click', '#add_keylist_url_btn', function(e) {
            e.preventDefault();
            
            if(validateRegister($('#add_keylist_url_form')) == false){
                return false;
            } else {
                // ajax submit
                $('#keylist_title_id').val($('.key__list__tab.active').attr('data-id'));

                var form_data = new FormData(document.getElementById("add_keylist_url_form"));

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
                        location.reload(true);
                    }
                });
            }
        });

        $('#add_url').on('hidden.bs.modal', function (e) {
            $('#add_keylist_url_form')[0].reset();
            $('.error-msg').remove();
            var add_title_btn = $('#add_keylist_url_btn');
            add_title_btn.removeAttr('disabled');
            add_title_btn.html('Save');
        })

    </script>
@endpush
