<div class="row py-1 a-v-center px-3">
    <div class="col-md-12">
        <div class="row main-chat-row-append" id="main__comment__form">
            <div class="col-md-10 text-left help-block">
                <label for="" class="hide">Comment</label>
                <input type="text" id="comment" data-validate="required" placeholder="comment here" class="form-control">
                <span aria-hidden="true" class="main-close-btn">&times;</span>
            </div>
            <div class="col-md-2">
                <button type="button" data-tbl="{{$tbl}}" id="comment_btn" class="btn main-chat-post-btn">Post</button>
            </div>

        </div>
    </div>
</div>
<hr class="mt-0">

<div class="display__comments">
    
    @foreach ($comments as $key => $item)
    
        <div class="row py-1 px-3 comment__block" id="comment__block__{{$item->id}}">
            <div class="col-md-10 text-left">
                <div class="comment-box">
                    <p class="para-comment line_height"><strong>{{ $item->usersProfile->full_name }}</strong>
                        {{ $item->comments }}</p>
                    <p class="small-txt para-date-comment line_height">
                        <?php echo Carbon\Carbon::parse($item->created_at)->diffForHumans(); ?>
                    </p>
                    <p class="small-txt reply-txt reply__event" id="replay">Reply</p>
                </div>
                <div class="row chat-row-append" id="reply__comment__form__{{$item->id}}">
                    <div class="col-md-10 text-left help-block">
                        <label for="" class="hide">Comment</label>
                        <input type="text" id="comment_{{$item->id}}" data-validate="required" placeholder="comment here" class="form-control">
                        <span aria-hidden="true" class="close-btn">&times;</span>
                    </div>
                    <div class="col-md-2">
                        <button type="button" data-tbl="{{$tbl}}" data-parent="{{ $item->id }}" data-id="{{$item->id}}" class="btn post-btn reply__comment__btn">Post</button>
                    </div>
                    
                </div>
            </div>
            <?php $user_profiles = \General::getUserProfilesIdFromUser(Auth::guard('user')->user()->id); ?>
            @if(in_array($item->commenter_id, $user_profiles))
                <div class="col-md-2 text-right">
                    <i class="fa fa-trash-o red-trash delete__comment cursor-pointer" data-id="{{ $item->id }}" aria-hidden="true"></i>
                </div>
            @endif
        </div>
        <div class="reply__section__{{$item->id}}">
            <?php $reply_comment = \General::getRplyComments($tbl, $media_id, $item->id); ?>
            @if(!empty($reply_comment)) 
                @foreach ($reply_comment as $k => $val)
                    
                    <div class="row py-1 px-3 comment__block" id="comment__block__{{$val->id}}">
                        <div class="col-md-10 text-left">
                            <div class="comment-box innersub-comment">
                                <p class="para-comment line_height"><strong>{{ $val->usersProfile->full_name }}</strong>
                                    {{ $val->comments }}</p>
                                <p class="small-txt para-date-comment line_height">
                                    <?php echo Carbon\Carbon::parse($val->created_at)->diffForHumans(); ?>
                                </p>
                                <p class="small-txt reply-txt reply__event" id="replay">Reply</p>
                            </div>
                            <div class="row chat-row-append" id="reply__comment__form__{{$val->id}}">
                                <div class="col-md-10 text-left help-block">
                                    <label for="" class="hide">Comment</label>
                                    <input type="text" id="comment_{{$val->id}}" data-validate="required" placeholder="comment here" class="form-control">
                                    <span aria-hidden="true" class="close-btn">&times;</span>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" data-tbl="{{$tbl}}" data-parent="{{ $item->id }}" data-id="{{$val->id}}" class="btn post-btn reply__comment__btn">Post</button>
                                </div>
                                
                            </div>
                        </div>
                        @if(in_array($val->commenter_id, $user_profiles))
                            <div class="col-md-2 text-right">
                                <i class="fa fa-trash-o red-trash delete__comment cursor-pointer" data-id="{{ $val->id }}" aria-hidden="true"></i>
                            </div>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>

        <hr>
    @endforeach

</div>

<script>
    $('.chat-row-append').hide();
    $(document).on('click', '.reply__event', function() {
        $(this).parents('.comment-box').next('.chat-row-append').show();
    });
    $(document).on('click', '.close-btn', function() {
        $('.chat-row-append').hide();
    });

    $('.main-chat-row-append').hide();
    $(document).on('click', '#main-chat', function() {
        $('.main-chat-row-append').show();
    });
    $(document).on('click', '.main-close-btn', function() {
        $('.main-chat-row-append').hide();
    });

    $(document).on('click', '#comment_btn', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        if(validateRegister($('#main__comment__form')) == false) {
            return false;
        } else {
            
            var comments = $('#comment').val();
            var users_profile_id = $('.comment_profile').find('.active__profile').find('.users__profiles.active').attr('data-id');
            var users_name = $('.comment_profile').find('.active__profile').find('.users__profiles.active').attr('data-name');
            var media = $('.comment_profile').find('.active__profile').find('.users__profiles.active').attr('data-media');
            var tbl = $(this).attr('data-tbl');
            $('#comment_btn').attr('disabled', 'disabled');
            $('#comment_btn').html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                url: "{{ route('post.comment') }}",
                type: 'post',
                data: {'comments': comments, 'tbl': tbl, 'user_name': users_name, 'commenter_id': users_profile_id, 'users_profile_media_id': media, '_token': "{{ csrf_token() }}" },
                success:function(response) {
                    $('#comment_btn').removeAttr('disabled');
                    $('.main-chat-row-append').hide();
                    $('#comment_btn').html('Post');
                    $('#comment').val('');
                    $('.display__comments').prepend(response);
                }
            });
        }
    });

    $(document).on('click', '.reply__comment__btn', function(e) {
        
        e.preventDefault();
        e.stopImmediatePropagation();
        var comment_id = $(this).attr('data-id');
        var parent_comment_id = $(this).attr('data-parent');
        var comment_block_id = $(this).parents('.comment__block').attr('id');
        if(validateRegister($('#' + comment_block_id )) == false) {
            return false;
        } else {
            var btn = $(this);
            btn.attr('disabled', 'disabled');
            btn.html('<i class="fa fa-spinner fa-spin"></i>');
            
            var comments = $('#' + comment_block_id).find('#comment_' + comment_id).val();
            var users_profile_id = $('.comment_profile').find('.active__profile').find('.users__profiles.active').attr('data-id');
            var users_name = $('.comment_profile').find('.active__profile').find('.users__profiles.active').attr('data-name');
            var media = $('.comment_profile').find('.active__profile').find('.users__profiles.active').attr('data-media');
            var tbl = $(this).attr('data-tbl');
            $.ajax({
                url: "{{ route('post.comment') }}",
                type: 'post',
                data: {'comments': comments, 'tbl': tbl, 'parent_comment_id': parent_comment_id, 'is_reply': 1, 'reply_comment_id': comment_id, 'user_name': users_name, 'commenter_id': users_profile_id, 'users_profile_media_id': media, '_token': "{{ csrf_token() }}" },
                success:function(response) {
                    btn.removeAttr('disabled');
                    btn.html('Post');
                    $('.chat-row-append').hide();
                    $('#' + comment_block_id).find('#comment_' + comment_id).val('');
                    $('.reply__section__' + parent_comment_id).append(response);
                }
            });
        }
    });

    $(document).on('click', '.delete__comment', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        var comment_id = $(this).attr('data-id');
        if(confirm('Are you sure you want to delete the comment?')) {
            $.ajax({
                url: "{{ route('delete.comment') }}",
                type: 'post',
                data: {'tbl': "{{$tbl}}", 'id': comment_id, '_token': "{{ csrf_token() }}" },
                success:function(response) {
                    $('#comment__block__' + comment_id).remove();
                    $('.reply__section__' + comment_id).remove();
                }
            });
        }
    });
</script>
