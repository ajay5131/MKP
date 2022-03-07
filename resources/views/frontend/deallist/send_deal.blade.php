{!! Form::open(array('method' => 'post', 'class' => 'form', 'id' => 'send_deal_form', 'files'=>true)) !!}

    <input type="hidden" name="sender_id" value="{{ Auth::guard('user')->user()->id }}">
    <input type="hidden" name="receiver_id" value="{{ $receiver_user }}">
    <div class="row align-v-center">
        <div class="col-md-2">
            From
        </div>
        <?php $usersProfile = \General::getUserProfiles(Auth::guard('user')->user()->id); ?>
        <div class="col-md-4">
            <select name="profile_id" class="form-control">
                @foreach ($usersProfile as $key => $value)
                    <option value="{{ $value->profile_id }}">{{ $value->profile_name }}</option>
                @endforeach
            </select>

        </div>
        <div class="col-md-6">
            <a href="#" data-toggle="modal" data-target="#already_know_this_person">Already know this Person</a>
        </div>
    </div>
    <div class="row pt-3">
        <div class="col-md-12">
            <h5 class="modal-title" id="propose-a-deal">Propose a Deal</h5>
        </div>
    </div>

    <div class="row pt-3 text-left">
        <div class="col-md-12 text-left">
            <label class="pl-2">Select Type</label>
            <div class="col-md-12 text-left">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="deal_type" value="Paid Offer" id="paid-offer-1">
                    <label class="form-check-label" for="paid-offer-1">
                        Paid Offer
                    </label>
                </div>
            </div>
            <div class="col-md-12 text-left">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="deal_type" value="Partnership" id="partnership-2">
                    <label class="form-check-label" for="partnership-2">
                        Partnership
                    </label>
                </div>
            </div>
            <div class="col-md-12 text-left">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="deal_type" value="Skill and Home Swap" id="skill-home-swap-3">
                    <label class="form-check-label" for="skill-home-swap-3">
                        Skill & Home Swap
                    </label>
                </div>
            </div>

            <div class="col-md-12 text-left py-3">
                <label class="mb-0">Attached Project</label>
                <select name="projects_id" class="form-control">
                    <option value="">Select a project</option>
                    @foreach ($projects as $key => $value)
                        <option value="{{ $value->id }}">{{ $value->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-12 text-left py-3">
                <label class="mb-0">Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <div class="col-md-12 text-left py-3">
                <button type="submit" id="send_deal_submit" class="form-control btn btn-primary btn-var">Submit</button>
            </div>

        </div>
    </div>

{!! Form::close() !!}
