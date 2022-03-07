@if (!empty($profile_overview))
    
    <div class="container-fluid sub-nav-my-profile">
        <ul class="nav">
            <?php 
                $users_profiles_route = \General::getUserProfiles($profile_overview->users_id);
            ?>
            
            <?php foreach ($users_profiles_route as $key => $value) { ?>
                <li class="nav-item">
                    <!-- active -->
                    <?php $route = Config::get('global.profile_routes')[$value->profile_id]; ?>
                    <?php 
                        $url ='#';
                        if(\Request::route()->getName() != $route) {
                            $url = route($route, $value->handle_name);
                        }
                    ?>
                    <a class="nav-link {{ (\Request::route()->getName() == $route ? 'active' : '') }}" href="<?php echo $url  ?>">{{ $value->profile_name }}</a>
                </li>
            <?php }?>
        </ul>
    </div>

@endif
