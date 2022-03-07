<div id="review-box">
    <div class="row">
        <div class="col-md-6">
            <h5><span class="highlight-box review_count">0</span> Reviews</h5>
        </div>
        @if (!$can_update)
            @if (Auth::guard('user')->check())
                @if(!\General::isReviewWritten($user_profile_id, Auth::guard('user')->user()->id, $profile_id))
                    
                    <div class="col-md-6 text-right">
                        <h5>
                            <a href="javascript:void;" class="write-a-review" onclick="openModal('write-a-review', '{{route('add.review', ['profile_id' => $profile_id, 'user_profile' => $user_profile_id])}}')" >Write a Review</a>
                        </h5>
                    </div>
                @endif
            @endif
        @endif
    </div>
    <div class="inner-review-box">
        <i class="fa fa-spinner fa-spin"></i>
    </div>
</div>

<div class="modal fade" id="write-a-review" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateprofilepicModalLabel">Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modelDataLoad">
                
            </div>
        </div>
    </div>
</div>
