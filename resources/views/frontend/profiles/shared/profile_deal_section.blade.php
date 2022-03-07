@if($can_update)
    <div class="profile-circle-deal-list" onclick="openModal('profile-circle-deal-list', '{{route('deal.list', ['profile_id' => $profile_id, 'user_profile' => $user_profile_id, 'media_type' => 'UsersProfile' ])}}')" >
        <p>@lang('messages.deal_list')</p>
    </div>
@else
    <?php 
        $send_deal_url = "return false;";
        if(Auth::guard('user')->check()) {
            $send_deal_url = "openModal('profile-send-deal-list', '". route('send.deal', ['profile_id' => $profile_id, 'user_profile' => $user_profile_id, 'media_type' => 'UsersProfile' ]) ."}}')";
        }
    ?>
    <div class="profile-circle-deal-list" onclick="{{ $send_deal_url }}" >
        <p>@lang('messages.send_deal')</p>
    </div>
@endif