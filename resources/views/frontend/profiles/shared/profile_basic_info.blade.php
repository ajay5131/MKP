
{!! Form::open(array('method' => 'post', 'class' => 'form', 'id' => 'basic_info_form', 'files'=>true)) !!}
    <input type="hidden" name="profile_id" value="{{$profile_id}}">
    <input type="hidden" name="user" value="{{$user_profile_id}}">

    <div class="row">
        <div class="col-md-8">
            <h3>Basic Infos</h3>
        </div>
        @if ($can_update)
            <div class="col-md-4 text-right">
                <i class="fa fa-pencil edit-btn-icon" aria-hidden="true" id="edit-form"></i>
                <button type="button" class="cancel-btn">@lang('messages.cancel')</button>
                <button type="button" id="basic_info_submit" class="submit-btn">@lang('messages.submit')</button>
            </div>
        @endif
    </div>

    <div class="info">
        <div class="row box">
            <div class="col-md-6 col-lg-3">
                <label>@lang('messages.height')</label>
            </div>
            <div class="col-md-6 col-lg-3">
                <?php $heights = explode(',', \Config::get('global.height')); ?>
                <label class="label-show"><?php echo isset($basic_info) ? $heights[$basic_info->height] : '' ?></label>
                <div class="input-show">
                    {!! Form::select('height', ['' => 'Select'] + $heights, (isset($basic_info->height) ? $basic_info->height : null), array('class'=>'form-control select2 mb-15')) !!}
                </div>
            </div>
            @if(in_array($profile_id, [3,4])) 
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.head')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <?php $heads = explode(',', \Config::get('global.head')); ?>
                    <label class="label-show"><?php echo isset($basic_info->head) ? $heads[$basic_info->head] : '' ?></label>
                    <div class="input-show">
                        {!! Form::select('head', ['' => 'Select'] + $heads, (isset($basic_info->head) ? $basic_info->head : null), array('class'=>'form-control select2 mb-15')) !!}
                    </div>
                </div>
            @endif

            @if(!in_array($profile_id, [3,4]) ) 
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.favourite_books')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="label-show"><?php echo (isset($basic_info->favourite_books) ? $basic_info->favourite_books : null) ?> </label>
                    <div class="input-show">
                        {!! Form::text('favourite_books', (isset($basic_info->favourite_books) ? $basic_info->favourite_books : null), array('class'=>'form-control mb-15', 'maxlength' => '255', 'autocomplete' => 'off')) !!}
                    </div>
                </div>
            @endif
        </div>

        <div class="row box">
            <div class="col-md-6 col-lg-3">
                <label>@lang('messages.weight')</label>
            </div>
            <div class="col-md-6 col-lg-3">
                <?php $weight = explode(',', \Config::get('global.weight')); ?>
                <label class="label-show"><?php echo isset($basic_info->weight) ? $weight[$basic_info->weight] : '' ?></label>
                <div class="input-show">
                    {!! Form::select('weight', ['' => 'Select'] + $weight, (isset($basic_info->weight) ? $basic_info->weight : null), array('class'=>'form-control select2 mb-15')) !!}
                </div>
            </div>

            @if(in_array($profile_id, [3,4])) 
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.neck')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <?php $necks = explode(',', \Config::get('global.neck')); ?>
                    <label class="label-show"><?php echo isset($basic_info->neck) ? $necks[$basic_info->neck] : '' ?></label>
                    <div class="input-show">
                        {!! Form::select('neck', ['' => 'Select'] + $necks, (isset($basic_info->neck) ? $basic_info->neck : null), array('class'=>'form-control select2 mb-15')) !!}
                    </div>
                </div>
            @endif

            @if(!in_array($profile_id, [3,4]) ) 
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.favourite_films')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="label-show"><?php echo (isset($basic_info->favourite_films) ? $basic_info->favourite_films : null) ?> </label>
                    <div class="input-show">
                        {!! Form::text('favourite_films', (isset($basic_info->favourite_films) ? $basic_info->favourite_films : null), array('class'=>'form-control mb-15', 'maxlength' => '255', 'autocomplete' => 'off')) !!}
                    </div>
                </div>
            @endif
        </div>

        <div class="row box">
            <div class="col-md-6 col-lg-3">
                <label>@lang('messages.ethnicity')</label>
            </div>
            <div class="col-md-6 col-lg-3">
                <?php $ethnicity = explode(',', \Config::get('global.ethnicity')); ?>
                <label class="label-show"><?php echo isset($basic_info->ethnicity) ? $ethnicity[$basic_info->ethnicity] : '' ?></label>
                <div class="input-show">
                    {!! Form::select('ethnicity', ['' => 'Select'] + $ethnicity, (isset($basic_info->ethnicity) ? $basic_info->ethnicity : null), array('class'=>'form-control select2 mb-15')) !!}
                </div>
            </div>

            @if(in_array($profile_id, [3,4])) 
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.chest_cup_size')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <?php $chest = explode(',', \Config::get('global.chest')); ?>
                    <label class="label-show"><?php echo isset($basic_info->chest_cup_size) ? $chest[$basic_info->chest_cup_size] : '' ?></label>
                    <div class="input-show">
                        {!! Form::select('chest_cup_size', ['' => 'Select'] + $chest, (isset($basic_info->chest_cup_size) ? $basic_info->chest_cup_size : null), array('class'=>'form-control select2 mb-15')) !!}
                    </div>
                </div>
            @endif

            @if(!in_array($profile_id, [3,4]) ) 
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.favourite_tv_shows') </label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="label-show"><?php echo (isset($basic_info->favourite_tv_shows) ? $basic_info->favourite_tv_shows : null) ?> </label>
                    <div class="input-show">
                        {!! Form::text('favourite_tv_shows', (isset($basic_info->favourite_tv_shows) ? $basic_info->favourite_tv_shows : null), array('class'=>'form-control mb-15', 'maxlength' => '255', 'autocomplete' => 'off')) !!}
                    </div>
                </div>
            @endif
        </div>

        <div class="row box">
            <div class="col-md-6 col-lg-3">
                <label>@lang('messages.skin_color')</label>
            </div>
            <div class="col-md-6 col-lg-3">
                <?php $skin_color = explode(',', \Config::get('global.skin_color')); ?>
                <label class="label-show"><?php echo isset($basic_info->skin_color) ? $skin_color[$basic_info->skin_color] : '' ?></label>
                <div class="input-show">
                    {!! Form::select('skin_color', ['' => 'Select'] + $skin_color, (isset($basic_info->skin_color) ? $basic_info->skin_color : null), array('class'=>'form-control select2 mb-15')) !!}
                </div>
            </div>

            @if(in_array($profile_id, [3,4])) 
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.bust')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <?php $bust = explode(',', \Config::get('global.bust')); ?>
                    <label class="label-show"><?php echo isset($basic_info->bust) ? $bust[$basic_info->bust] : '' ?></label>
                    <div class="input-show">
                        {!! Form::select('bust', ['' => 'Select'] + $bust, (isset($basic_info->bust) ? $basic_info->bust : null), array('class'=>'form-control select2 mb-15')) !!}
                    </div>
                </div>
            @endif

            @if(!in_array($profile_id, [3,4]) ) 
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.favourite_animes_cartoons') </label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="label-show"><?php echo (isset($basic_info->favourite_animes_cartoons) ? $basic_info->favourite_animes_cartoons : null) ?> </label>
                    <div class="input-show">
                        {!! Form::text('favourite_animes_cartoons', (isset($basic_info->favourite_animes_cartoons) ? $basic_info->favourite_animes_cartoons : null), array('class'=>'form-control mb-15', 'maxlength' => '255', 'autocomplete' => 'off')) !!}
                    </div>
                </div>
            @endif
        </div>

        <div class="row box">
            <div class="col-md-6 col-lg-3">
                <label>@lang('messages.eyes_color')</label>
            </div>
            <div class="col-md-6 col-lg-3">
                <?php $eyes_color = explode(',', \Config::get('global.eyes_color')); ?>
                <label class="label-show"><?php echo isset($basic_info->eyes_color) ? $eyes_color[$basic_info->eyes_color] : '' ?></label>
                <div class="input-show">
                    {!! Form::select('eyes_color', ['' => 'Select'] + $eyes_color, (isset($basic_info->eyes_color) ? $basic_info->eyes_color : null), array('class'=>'form-control select2 mb-15')) !!}
                </div>
            </div>

            @if(in_array($profile_id, [3,4])) 
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.waist')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <?php $waist = explode(',', \Config::get('global.waist')); ?>
                    <label class="label-show"><?php echo isset($basic_info->waist) ? $waist[$basic_info->waist] : '' ?></label>
                    <div class="input-show">
                        {!! Form::select('waist', ['' => 'Select'] + $waist, (isset($basic_info->waist) ? $basic_info->waist : null), array('class'=>'form-control select2 mb-15')) !!}
                    </div>
                </div>
            @endif

            @if(!in_array($profile_id, [3,4]) ) 
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.favourite_artists') </label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="label-show"><?php echo (isset($basic_info->favourite_artists) ? $basic_info->favourite_artists : null) ?> </label>
                    <div class="input-show">
                        {!! Form::text('favourite_artists', (isset($basic_info->favourite_artists) ? $basic_info->favourite_artists : null), array('class'=>'form-control mb-15', 'maxlength' => '255', 'autocomplete' => 'off')) !!}
                    </div>
                </div>
            @endif
        </div>

        <div class="row box">
            <div class="col-md-6 col-lg-3">
                <label>@lang('messages.hair_color')</label>
            </div>
            <div class="col-md-6 col-lg-3">
                <?php $hair_color = explode(',', \Config::get('global.hair_color')); ?>
                <label class="label-show"><?php echo isset($basic_info->hair_color) ? $hair_color[$basic_info->hair_color] : '' ?></label>
                <div class="input-show">
                    {!! Form::select('hair_color', ['' => 'Select'] + $hair_color, (isset($basic_info->hair_color) ? $basic_info->hair_color : null), array('class'=>'form-control select2 mb-15')) !!}
                </div>
            </div>

            @if(in_array($profile_id, [3,4])) 
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.hip')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <?php $hip = explode(',', \Config::get('global.hips')); ?>
                    <label class="label-show"><?php echo isset($basic_info->hip) ? $hip[$basic_info->hip] : '' ?></label>
                    <div class="input-show">
                        {!! Form::select('hip', ['' => 'Select'] + $hip, (isset($basic_info->hip) ? $basic_info->hip : null), array('class'=>'form-control select2 mb-15')) !!}
                    </div>
                </div>
            @endif

            @if(!in_array($profile_id, [3,4]) ) 
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.favourite_music_genres')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="label-show"><?php echo (isset($basic_info->favourite_music_genres) ? $basic_info->favourite_music_genres : null) ?> </label>
                    <div class="input-show">
                        {!! Form::text('favourite_music_genres', (isset($basic_info->favourite_music_genres) ? $basic_info->favourite_music_genres : null), array('class'=>'form-control mb-15', 'maxlength' => '255', 'autocomplete' => 'off')) !!}
                    </div>
                </div>
            @endif
        </div>

        <div class="row box">
            <div class="col-md-6 col-lg-3">
                <label>@lang('messages.hair_length')</label>
            </div>
            <div class="col-md-6 col-lg-3">
                <?php $hair_length = explode(',', \Config::get('global.hair_length')); ?>
                <label class="label-show"><?php echo isset($basic_info->hair_length) ? $hair_length[$basic_info->hair_length] : '' ?></label>
                <div class="input-show">
                    {!! Form::select('hair_length', ['' => 'Select'] + $hair_length, (isset($basic_info->hair_length) ? $basic_info->hair_length : null), array('class'=>'form-control select2 mb-15')) !!}
                </div>
            </div>

            @if(in_array($profile_id, [3,4])) 
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.dress_size')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <?php $dress_size = Config::get('global.dress_size'); ?>
                    <label class="label-show"><?php echo isset($basic_info->dress_size) ? $dress_size[$basic_info->dress_size] : '' ?></label>
                    <div class="input-show">
                        {!! Form::select('dress_size', ['' => 'Select'] + $dress_size, (isset($basic_info->dress_size) ? $basic_info->dress_size : null), array('class'=>'form-control select2 mb-15')) !!}
                    </div>
                </div>
            @endif

            @if(!in_array($profile_id, [3,4]) ) 
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.favourite_songs')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="label-show"><?php echo (isset($basic_info->favourite_songs) ? $basic_info->favourite_songs : null) ?> </label>
                    <div class="input-show">
                        {!! Form::text('favourite_songs', (isset($basic_info->favourite_songs) ? $basic_info->favourite_songs : null), array('class'=>'form-control mb-15', 'maxlength' => '255', 'autocomplete' => 'off')) !!}
                    </div>
                </div>
            @endif
        </div>

        <div class="row box">
            <div class="col-md-6 col-lg-3">
                <label>@lang('messages.hair_type')</label>
            </div>
            <div class="col-md-6 col-lg-3">
                <?php $hair_type = explode(',', \Config::get('global.hair_type')); ?>
                <label class="label-show"><?php echo isset($basic_info->hair_type) ? $hair_type[$basic_info->hair_type] : '' ?></label>
                <div class="input-show">
                    {!! Form::select('hair_type', ['' => 'Select'] + $hair_type, (isset($basic_info->hair_type) ? $basic_info->hair_type : null), array('class'=>'form-control select2 mb-15')) !!}
                </div>
            </div>

            @if(in_array($profile_id, [3,4])) 
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.shoe_size')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <?php $shoe_size = explode(',', \Config::get('global.shoe_size')); ?>
                    <label class="label-show"><?php echo isset($basic_info->shoe_size) ? $shoe_size[$basic_info->shoe_size] : '' ?></label>
                    <div class="input-show">
                        {!! Form::select('shoe_size', ['' => 'Select'] + $shoe_size, (isset($basic_info->shoe_size) ? $basic_info->shoe_size : null), array('class'=>'form-control select2 mb-15')) !!}
                    </div>
                </div>
            @endif

            @if(!in_array($profile_id, [3,4]) ) 
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.favourite_things')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="label-show"><?php echo (isset($basic_info->favourite_things) ? $basic_info->favourite_things : null) ?> </label>
                    <div class="input-show">
                        {!! Form::text('favourite_things', (isset($basic_info->favourite_things) ? $basic_info->favourite_things : null), array('class'=>'form-control mb-15', 'maxlength' => '255', 'autocomplete' => 'off')) !!}
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if(!in_array($profile_id, [3,4]) ) 
        <div class="row">
            <div class="col-md-12">
                <p class="v-hide">Dummy Text</p>
            </div>
        </div>
        <div class="info">
            <div class="row box">
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.nationality')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <?php $nationality = \General::getAllNationality(); ?>
                    <label class="label-show"><?php echo isset($basic_info->nationality_id) ? $nationality[$basic_info->nationality_id] : '' ?></label>
                    <div class="input-show">
                        {!! Form::select('nationality_id', ['' => 'Select'] + $nationality, (isset($basic_info->nationality_id) ? $basic_info->nationality_id : null), array('class'=>'form-control select2 mb-15')) !!}
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.favourite_places')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="label-show"><?php echo (isset($basic_info->favourite_places) ? $basic_info->favourite_places : null) ?> </label>
                    <div class="input-show">
                        {!! Form::text('favourite_places', (isset($basic_info->favourite_places) ? $basic_info->favourite_places : null), array('class'=>'form-control mb-15', 'maxlength' => '255', 'autocomplete' => 'off')) !!}
                    </div>
                </div>
            </div>

            <div class="row box">
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.originally_from')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <?php $originally_from = \General::getAllCountry(); ?>
                    <label class="label-show"><?php echo isset($basic_info->originally_from) ? $originally_from[$basic_info->originally_from] : '' ?></label>
                    <div class="input-show">
                        {!! Form::select('originally_from', ['' => 'Select'] + $originally_from, (isset($basic_info->originally_from) ? $basic_info->originally_from : null), array('class'=>'form-control select2 mb-15')) !!}
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.favourite_sports')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="label-show"><?php echo (isset($basic_info->favourite_sports) ? $basic_info->favourite_sports : null) ?> </label>
                    <div class="input-show">
                        {!! Form::text('favourite_sports', (isset($basic_info->favourite_sports) ? $basic_info->favourite_sports : null), array('class'=>'form-control mb-15', 'maxlength' => '255', 'autocomplete' => 'off')) !!}
                    </div>
                </div>
            </div>

            <div class="row box">
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.civil_status')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="label-show"><?php echo (isset($basic_info->civil_status) ? $basic_info->civil_status : null) ?> </label>
                    <div class="input-show">
                        {!! Form::text('civil_status', (isset($basic_info->civil_status) ? $basic_info->civil_status : null), array('class'=>'form-control mb-15', 'maxlength' => '255', 'autocomplete' => 'off')) !!}
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.favourite_pastimes')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="label-show"><?php echo (isset($basic_info->favourite_pastimes) ? $basic_info->favourite_pastimes : null) ?> </label>
                    <div class="input-show">
                        {!! Form::text('favourite_pastimes', (isset($basic_info->favourite_pastimes) ? $basic_info->favourite_pastimes : null), array('class'=>'form-control mb-15', 'maxlength' => '255', 'autocomplete' => 'off')) !!}
                    </div>
                </div>
            </div>

            <div class="row box">
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.studies')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="label-show"><?php echo (isset($basic_info->studies) ? $basic_info->studies : null) ?> </label>
                    <div class="input-show">
                        {!! Form::text('studies', (isset($basic_info->studies) ? $basic_info->studies : null), array('class'=>'form-control mb-15', 'maxlength' => '255', 'autocomplete' => 'off')) !!}
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.favourite_animals')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="label-show"><?php echo (isset($basic_info->favourite_animals) ? $basic_info->favourite_animals : null) ?> </label>
                    <div class="input-show">
                        {!! Form::text('favourite_animals', (isset($basic_info->favourite_animals) ? $basic_info->favourite_animals : null), array('class'=>'form-control mb-15', 'maxlength' => '255', 'autocomplete' => 'off')) !!}
                    </div>
                </div>
            </div>

            <div class="row box">
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.skills')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="label-show"><?php echo (isset($basic_info->skills) ? $basic_info->skills : null) ?> </label>
                    <div class="input-show">
                        {!! Form::text('skills', (isset($basic_info->skills) ? $basic_info->skills : null), array('class'=>'form-control mb-15', 'maxlength' => '255', 'autocomplete' => 'off')) !!}
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.favourite_colors')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="label-show"><?php echo (isset($basic_info->favourite_colors) ? $basic_info->favourite_colors : null) ?> </label>
                    <div class="input-show">
                        {!! Form::text('favourite_colors', (isset($basic_info->favourite_colors) ? $basic_info->favourite_colors : null), array('class'=>'form-control mb-15', 'maxlength' => '255', 'autocomplete' => 'off')) !!}
                    </div>
                </div>
            </div>


            <div class="row box">
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.religion')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="label-show"><?php echo (isset($basic_info->religion) ? $basic_info->religion : null) ?> </label>
                    <div class="input-show">
                        {!! Form::text('religion', (isset($basic_info->religion) ? $basic_info->religion : null), array('class'=>'form-control mb-15', 'maxlength' => '255', 'autocomplete' => 'off')) !!}
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.favourite_foods')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="label-show"><?php echo (isset($basic_info->favourite_foods) ? $basic_info->favourite_foods : null) ?> </label>
                    <div class="input-show">
                        {!! Form::text('favourite_foods', (isset($basic_info->favourite_foods) ? $basic_info->favourite_foods : null), array('class'=>'form-control mb-15', 'maxlength' => '255', 'autocomplete' => 'off')) !!}
                    </div>
                </div>
            </div>


            <div class="row box">
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.children')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="label-show"><?php echo (isset($basic_info) ? $basic_info->children : null) ?> </label>
                    <div class="input-show">
                        {!! Form::text('children', (isset($basic_info) ? $basic_info->children : null), array('class'=>'form-control mb-15', 'maxlength' => '255', 'autocomplete' => 'off')) !!}
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.favourite_drinks')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="label-show"><?php echo (isset($basic_info->favourite_drinks) ? $basic_info->favourite_drinks : null) ?> </label>
                    <div class="input-show">
                        {!! Form::text('favourite_drinks', (isset($basic_info->favourite_drinks) ? $basic_info->favourite_drinks : null), array('class'=>'form-control mb-15', 'maxlength' => '255', 'autocomplete' => 'off')) !!}
                    </div>
                </div>
            </div>

            <div class="row box">
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.smoking_drinking') </label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="label-show"><?php echo (isset($basic_info->smoking_drinking) ? $basic_info->smoking_drinking : null) ?> </label>
                    <div class="input-show">
                        {!! Form::text('smoking_drinking', (isset($basic_info->smoking_drinking) ? $basic_info->smoking_drinking : null), array('class'=>'form-control mb-15', 'maxlength' => '255', 'autocomplete' => 'off')) !!}
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.favourite_games')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="label-show"><?php echo (isset($basic_info->favourite_games) ? $basic_info->favourite_games : null) ?> </label>
                    <div class="input-show">
                        {!! Form::text('favourite_games', (isset($basic_info->favourite_games) ? $basic_info->favourite_games : null), array('class'=>'form-control mb-15', 'maxlength' => '255', 'autocomplete' => 'off')) !!}
                    </div>
                </div>
            </div>



        </div>
        <!--  -->
        <div class="row">
            <div class="col-md-12">
                <p class="v-hide">Dummy Text</p>
            </div>
        </div>
        <div class="info">
            <div class="row box">
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.personality')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="label-show"><?php echo (isset($basic_info->personality) ? $basic_info->personality : null) ?> </label>
                    <div class="input-show">
                        {!! Form::text('personality', (isset($basic_info->personality) ? $basic_info->personality : null), array('class'=>'form-control mb-15', 'maxlength' => '255', 'autocomplete' => 'off')) !!}
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.favourite_proverbs')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="label-show"><?php echo (isset($basic_info->favourite_proverbs) ? $basic_info->favourite_proverbs : null) ?> </label>
                    <div class="input-show">
                        {!! Form::text('favourite_proverbs', (isset($basic_info->favourite_proverbs) ? $basic_info->favourite_proverbs : null), array('class'=>'form-control mb-15', 'maxlength' => '255', 'autocomplete' => 'off')) !!}
                    </div>
                </div>
            </div>

            <div class="row box">
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.qualities')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="label-show"><?php echo (isset($basic_info->qualities) ? $basic_info->qualities : null) ?> </label>
                    <div class="input-show">
                        {!! Form::text('qualities', (isset($basic_info->qualities) ? $basic_info->qualities : null), array('class'=>'form-control mb-15', 'maxlength' => '255', 'autocomplete' => 'off')) !!}
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.favourite_figures')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="label-show"><?php echo (isset($basic_info->favourite_figures) ? $basic_info->favourite_figures : null) ?> </label>
                    <div class="input-show">
                        {!! Form::text('favourite_figures', (isset($basic_info->favourite_figures) ? $basic_info->favourite_figures : null), array('class'=>'form-control mb-15', 'maxlength' => '255', 'autocomplete' => 'off')) !!}
                    </div>
                </div>
            </div>

            <div class="row box">
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.flaws')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="label-show"><?php echo (isset($basic_info->flaws) ? $basic_info->flaws : null) ?> </label>
                    <div class="input-show">
                        {!! Form::text('flaws', (isset($basic_info->flaws) ? $basic_info->flaws : null), array('class'=>'form-control mb-15', 'maxlength' => '255', 'autocomplete' => 'off')) !!}
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label>@lang('messages.star_sign')</label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <?php $star_sign = explode(',', \Config::get('global.star_sign')); ?>
                    <label class="label-show"><?php echo isset($basic_info->star_sign) ? $star_sign[$basic_info->star_sign] : '' ?></label>
                    <div class="input-show">
                        {!! Form::select('star_sign', ['' => 'Select'] + $star_sign, (isset($basic_info->star_sign) ? $basic_info->star_sign : null), array('class'=>'form-control mb-15')) !!}
                    </div>
                </div>
            </div>


        </div>
    @endif

{!! Form::close() !!}

<script>
    $('.select2').select2();

    show_hide_input_label();
    function show_hide_input_label(){
        $('.input-show').hide();
        $('.submit-btn').hide();
        $('.cancel-btn').hide();
    }
    $(document).on('click', '#edit-form',function(e){
        e.stopPropagation();  
        e.preventDefault();      
        $('.input-show').show();
        $('.submit-btn').show();
        $('.cancel-btn').show();
        $('.label-show').hide();
        $('#edit-form').hide();
        e.stopImmediatePropagation();  
    });
    $(document).on('click', '.cancel-btn', function(e){
        e.stopPropagation();  
        e.preventDefault();      
        $('.input-show').hide();
        $('.submit-btn').hide();
        $('.cancel-btn').hide();
        $('.label-show').show();
        $('#edit-form').show();         
        e.stopImmediatePropagation();
    });


    $(document).on('click', '#basic_info_submit', function(e) {
        e.preventDefault();
        
        // ajax submit
        var form_data = new FormData(document.getElementById("basic_info_form"));

        $('.main-pro-tbl-box').html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax({
            url: "{{ route('update.profile.basic.info') }}",
            type: 'post',
            processData: false,
            contentType: false,
            data: form_data,
            success:function(response) {

                setTimeout(() => {
                    // Definition of function is in shared->scripts.blade.php
                    loadBasicInfo();
                }, 200);
            }
        })

    });
    
</script>

