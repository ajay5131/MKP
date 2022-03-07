{!! Form::open(array('method' => 'post', 'route' => 'add.review', 'class' => 'form', 'id' => 'review_form', 'files'=>true)) !!}

    <input type="hidden" name="users_profiles_id" value="{{$user_profile_id}}">
    
    <?php $reviewer = \General::getUserProfileByUserAndProfile(Auth::guard('user')->user()->id, $profile_id); ?>

    <input type="hidden" name="reviewer_users_profile_id" value="{{$reviewer}}">

    <div class="modal-body">
        <input type="hidden" name="rating" id="review_rating">
        <div class="form-group text-left review__star">
            <label class="modal-label"><strong>Rating:</strong></label>
            <i class="fa fa-star-o star-bg" aria-hidden="true"></i>
            <i class="fa fa-star-o star-bg" aria-hidden="true"></i>
            <i class="fa fa-star-o star-bg" aria-hidden="true"></i>
            <i class="fa fa-star-o star-bg" aria-hidden="true"></i>
            <i class="fa fa-star-o star-bg" aria-hidden="true"></i>
        </div>

        <div class="form-group text-left">
            <label class="modal-label"><strong>Description</strong></label>
            <textarea class="form-control" name="comment" autocomplete="off" data-validate="required"></textarea>

        </div>
        <div class="form-group text-left">
            <label class="modal-label"><strong>Get a Verified review (Optional):</strong></label>
            <input type="file" name="attachment" class="form-control adj-file-control" accept="image/jpg,image/png,image/jpeg,application/pdf">
        </div>
        <div class="form-group text-center">
            <label class="modal-label"><strong>OR</strong> </label>
        </div>
        <div class="form-group text-left">
            <input type="text" name="attachment_url" autocomplete="off" class="form-control" data-validate="url" placeholder="URL of a Project or Confirmation number of your booking">
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" onclick="return validateRegister($('#review_form'));"  class="btn bg-btn-color full-w">Save</button>
    </div>

{!! Form::close() !!}


<script>
    $('.review__star i[class*=fa-star]').click(function(){
        var i = $(this).index();
        var p = $(this).parent();
        
        p.children('i[class*=fa-star]').each(function(index, v){
            if (index < i) {
                $(this).addClass('fa-star');
                $(this).removeClass('fa-star-o');
            } else {
                $(this).addClass('fa-star-o');
                $(this).removeClass('fa-star');
            }
        })
        $('#review_rating').val(i);
    });
</script>