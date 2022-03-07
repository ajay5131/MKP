<ul class="job-overview-list">
    <li class="list-item-jobl">
        <div class="d-flex-row">
            <div>
                <i class="fa fa-eye job-o-list-icon" aria-hidden="true"></i>
            </div>
            <div>
                <span class="pl-20 f-14">Profile view</span>
            </div>
        </div>
        <div>
            <span class="f-w-600">{{ empty($profile_overview->profile_views) ? 0 : $profile_overview->profile_views }}</span>
        </div>
    </li>
    <li class="list-item-jobl">
        <div class="d-flex-row">
            <div>
                <i class="fa fa-users job-o-list-icon" aria-hidden="true"></i>
            </div>
            <div>
                <span class="pl-20 f-14">Followers</span>
            </div>
        </div>
        <div>
            <span class="f-w-600">{{ \General::countFollower($user_profile_id) }}</span>
        </div>
    </li>
    <li class="list-item-jobl">
        <div class="d-flex-row">
            <div>
                <i class="fa fa-file-text-o job-o-list-icon" aria-hidden="true"></i>
            </div>
            <div id="review">
                <span class="pl-20 f-14">Reviews 
                    <?php 
                    $rating = \General::ratingReview($user_profile_id);
                    if($rating > 0) {
                        echo '<i class="fa fa-star star-bg"></i> ' . $rating; 
                    }
                    ?>
                </span>
            </div>
        </div>
        <div>
            <span class="f-w-600">{{ \General::countReview($user_profile_id) }}</span>
        </div>
    </li>

    <li class="list-item-jobl">
        <div class="d-flex-row">
            <div>
                <i class="fa fa-folder-open job-o-list-icon" aria-hidden="true"></i>
            </div>
            <div>
                <span class="pl-20 f-14">Contributions</span>
            </div>
        </div>
        <div>
            <span class="f-w-600">0</span>
        </div>
    </li>
    <li class="list-item-jobl">
        <div class="d-flex-row">
            <div>
                <i class="fa fa-money job-o-list-icon" aria-hidden="true"></i>
            </div>
            <div>
                <span class="pl-20 f-14">Sponsorships</span>
            </div>
        </div>
        <div>
            <span class="f-w-600">0</span>
        </div>
    </li>
    <li class="list-item-jobl">
        <div class="d-flex-row">
            <div>
                <i class="fa fa-file-text-o job-o-list-icon" aria-hidden="true"></i>
            </div>
            <div>
                <span class="pl-20 f-14">Key People</span>
            </div>
        </div>
        <div>
            <span class="f-w-600">0</span>
        </div>
    </li>
    <li class="list-item-jobl">
        <div class="d-flex-row">
            <div>
                <i class="fa fa-diamond job-o-list-icon" aria-hidden="true"></i>
            </div>
            <div>
                <span class="pl-20 f-14">MKP Score</span>
            </div>
        </div>

        <div>
            <span class="f-w-600">0</span>
        </div>
    </li>

</ul>