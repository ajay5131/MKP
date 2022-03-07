<div class="modal fade" id="profile-reply-deal-list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateprofilepicModalLabel">New Deal Offer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modelDataLoad">
                
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->


<div class="modal fade" id="decline-deal-reply" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateprofilepicModalLabel">Decline Offer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left">
                <div class="row">
                    <div class="col-md-12">
                        <p class="mb-0">Reason of Decline</p>
                        <p><small>Reason of deal reject</small></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                        <input type="radio" name="reason" class="decline__reason" checked value="I'm not interested in your Offer">
                    </div>
                    <div class="col-md-11 text-left">
                        <span>I'm not interested in your Offer</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                        <input type="radio" name="reason" class="decline__reason" value="Your Price is too low">
                    </div>
                    <div class="col-md-11 text-left">
                        <span>Your Price is too low</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                        <input type="radio" name="reason" class="decline__reason" value="Busy with Projects">
                    </div>
                    <div class="col-md-11 text-left">
                        <span>Busy with Projects</span>
                    </div>
                </div>

                <div class="row d-flex justify-content-end">
                    <div class="col-md-3 text-left py-3">
                        <button type="button" id="decline__reason__submit" class="form-control btn btn-primary btn-var">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->

