<div class="row">
    <div class="col-md-3 btn-space pt-3">
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#report">Report</button>
        <?php $is_following = \General::isFollowing($user_profile_id, Auth::guard('user')->user()->id); ?>
        @if($is_following >= 1)
        
            {!! Form::open(array('method' => 'post', 'route' => 'delete.follower', 'class' => 'form', 'id' => 'basic_info_form', 'files'=>true)) !!}
                <input type="hidden" name="id" value="{{ $is_following }}">
                <button type="submit" class="btn btn-primary btn-theme" >Unfollow</button>
            {!! Form::close() !!}

        @else        
            <button type="button" class="btn btn-primary btn-theme" id="follow_btn" data-toggle="modal" data-target="#follow">Follow</button>
        @endif
    </div>
    <div class="col-md-7">
    </div>
</div>
