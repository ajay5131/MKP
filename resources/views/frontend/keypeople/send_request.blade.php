<div class="modal fade" id="already_know_this_person" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateprofilepicModalLabel">Send a MKP Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(array('method' => 'post', 'class' => 'form', 'id' => 'request_keypeople_form', 'files'=>true)) !!}
                    <input type="hidden" name="sender_id" value="{{ Auth::guard('user')->user()->id }}">
                    <?php $receiver_user = \General::getUserByProfileAndUserProfile($user_profile_id, $profile_id); ?>
                    <input type="hidden" name="receiver_id" value="{{ $receiver_user }}">
                    <div class="d-flex py-2 help-block">
                        <div class="col-md-2">
                            <label>PIN</label>
                        </div>
                        <div class="col-md-7 text-left">
                            <input type="text" autocomplete="off" data-validate="required,max:6" name="pin" class="form-control">
                            <span class="text-danger error-text" ></span>
                        </div>
                        <div class="col-md-3">
                            <button type="button" id="request_keypeople_submit" class="btn bg-btn-color">Submit</button>
                        </div>
                    </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
<!-- Find js code in script.blade.php file in profile folder-->