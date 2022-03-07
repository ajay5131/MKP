<div class="modal fade" id="report" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateprofilepicModalLabel">Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(array('method' => 'post', 'route' => 'report.profile', 'class' => 'form', 'id' => 'report_profile_form', 'files'=>true)) !!}
                    
                    <?php $reported_by = \General::getUserProfileByUserAndProfile(Auth::guard('user')->user()->id, $profile_id); ?>

                    <input type="hidden" name="reported_by_user_id" value="{{$reported_by}}">
                    <input type="hidden" name="reported_on_users_profiles_id" value="{{$user_profile_id}}">

                    <div class="row py-3">
                        <div class="col-md-12 text-left">
                            <label>Please Select a Problem</label>
                            <?php $problems = explode(',', \Config::get('global.report_profile_problem')); ?>
                            <select name="problem" class="form-control">
                                @foreach ($problems as $key => $value)
                                    <option value="{{ $value }}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row py-3">
                        <div class="col-md-12 text-left">
                            <label>Details </label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row py-3">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn bg-btn-color">Submit</button>
                        </div>
                    </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
</div>
