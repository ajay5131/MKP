<div class="modal fade" id="follow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateprofilepicModalLabel">Follow Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(array('method' => 'post', 'route' => 'update.follower', 'class' => 'form', 'id' => 'profile_follow_form', 'files'=>true)) !!}
                    <input type="hidden" name="users_profiles_id" value="{{$user_profile_id}}">
                    <div class="row py-3">
                        <div class="col-md-3 offset-md-1 text-left">
                            <label>From Profile </label>
                        </div>
                        <div class="col-md-7 text-left">
                            <?php $all_active_profiles = \General::getUserProfiles(Auth::guard('user')->user()->id); ?>
                            <select class="form-control" name="follower_users_profiles_id">
                                @foreach ($all_active_profiles as $key => $value)
                                    <option value="{{ $value->users_profiles_id }}">{{$value->profile_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-end pt-4">
                        <div class="col-md-3">
                            <button type="submit" class="btn bg-btn-color btn-color-w btn-sm btn-block">@lang('messages.save')</button>
                        </div>
                    </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
