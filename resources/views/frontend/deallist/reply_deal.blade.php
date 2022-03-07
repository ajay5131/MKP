{!! Form::open(array('method' => 'post', 'route' => 'reply.deal', 'class' => 'form', 'id' => 'reply_deal_form', 'files'=>true)) !!}

    <input type="hidden" name="media" value="{{$deal->id}}">
    <input type="hidden" name="decline_reason" id="reason" >
    <div class="decline_deal_block">

    </div>

    <div class="row">
        <div class="col-md-12 text-left">
            <p>Deal proposal from <a href="{{ route('main', $deal->getSenderName('handle_name')) }}">{{ $deal->getSenderName('full_name') }}</a></p>
        </div>
    </div>
    <div class="row pt-3">
        <div class="col-md-12 text-left">
            <table class="">
                <tbody>
                    <tr>
                        <th>Deal Type:</th>
                        <td class="p-2">{{$deal->deal_type}}</td>
                    </tr>
                    <tr>
                        <th>Description:</th>
                        <td class="p-2">{{$deal->description}}</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td class="p-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="javascript:void(0)" class="reply__deal__project">
                                        <img src="{{ asset('/') }}home/images/dummy-image.png">
                                        <p class="mb-0">Music Video</p>
                                        <p class="mb-0">Test Tab</p>
                                    </a>
                                </div>
                            </div>
                            
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
        
    </div>

    <div class="row d-flex justify-content-center mt-4">
        <div class="col-md-12">
            <button type="submit" name="reply_btn" value="decline_later" class="btn btn-secondary">Decline Later</button>
            <button type="button" data-toggle="modal" data-target="#decline-deal-reply" class="btn btn-danger">Decline</button>
            <button type="submit" name="reply_btn" value="accept" class="btn btn-primary btn-var">Accept</button>
        </div>
    </div>

{!! Form::close() !!}


<script>
    $(document).on('click', '#decline__reason__submit', function(e) {
        $(this).attr('disabled', 'disabled')
        $('#reason').val($('input[name="reason"]:checked').val());
        $('.decline_deal_block').html("<input type='hidden' name='reply_btn' value='decline'>");
        $('#reply_deal_form').submit();
    });
</script>


