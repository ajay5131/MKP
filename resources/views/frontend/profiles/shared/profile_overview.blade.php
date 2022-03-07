
{{-- <div class="arrow-down-up" id="arrow-up">
    <i class="fa fa-angle-down" aria-hidden="true" id="v-flip-arrow"></i>
</div> --}}

<?php $languages = \General::getAllLanguage(); ?>

<?php $show_looking_for = [1] ?>
<?php $show_interest = [1] ?>
<?php $show_genres = [2, 5] ?>
<?php $show_instruments = [2] ?>
<?php $show_influences = [2] ?>
<?php $show_types = [3, 4, 5] ?>
<?php $show_special_skills = [3, 4] ?>
<?php $show_price = [6, 7, 8, 9, 10] ?>
<?php $show_services = [6, 7, 9] ?>
<?php $show_facilities = [8] ?>
<?php $show_equipment = [8] ?>
<?php $show_address = [9] ?>
<?php $show_email = [9] ?>
<?php $show_telephone = [9] ?>
<?php $show_items = [10] ?>
            
    <div class="info-area">
        <div class="row">
            @if ($can_update)
                <div class="col-md-12 text-right">
                    <i class="fa fa-pencil edit-pencil" aria-hidden="true" id="edit-lang-look-interest"></i>
                </div>
            @endif

            <div class="col-md-12">
                <label class="mb-0"><strong>@lang('messages.languages')</strong></label>
                <p class="p-txt-color">
                    <?php 
                        if(!empty($overview->language_id)) {

                            $lang = explode(',', $overview->language_id);
                            $html = '';
                            foreach ($lang as $key => $value) {
                                $html = (empty($html) ? "" : $html . ", ") . $languages[$value];
                            }
                            echo empty($html) ? '&nbsp;' : $html;                            
                        }
                    ?>
                </p>
            </div>

            
            @if(in_array($profile_id, $show_looking_for) )
                <div class="col-md-12">
                    <label class="mb-0"><strong>@lang('messages.looking_for') :</strong></label>
                    <p class="p-txt-color"><?php echo empty($overview->looking_for) ? '&nbsp;' : $overview->looking_for ?></p>
                </div>
            @endif

            @if(in_array($profile_id, $show_interest) )
                <div class="col-md-12">
                    <label class="mb-0"><strong>@lang('messages.interested_in')</strong></label>
                    <div class="interested-info-row">
                        @if (!empty($overview->interest_id))
                            <?php echo \General::getInterestImagesById($overview->interest_id); ?>
                        @endif
                    </div>
                </div>
            @endif
            
            @if(in_array($profile_id, $show_types) )
                <div class="col-md-12">
                    <label class="mb-0"><strong>@lang('messages.types')</strong></label>
                    <p class="p-txt-color"><?php echo empty($overview->types) ? '&nbsp;' : $overview->types ?></p>
                </div>
            @endif
            
            @if(in_array($profile_id, $show_address) )
                <div class="col-md-12">
                    <label class="mb-0"><strong>@lang('messages.address')</strong></label>
                    <p class="p-txt-color"><?php echo empty($overview->company_address) ? '&nbsp;' : $overview->company_address ?></p>
                </div>
            @endif
            
            @if(in_array($profile_id, $show_telephone) )
                <div class="col-md-12">
                    <label class="mb-0"><strong>@lang('messages.phone')</strong></label>
                    <p class="p-txt-color"><?php echo empty($overview->company_telephone) ? '&nbsp;' : $overview->company_telephone ?></p>
                </div>
            @endif
            
            @if(in_array($profile_id, $show_email) )
                <div class="col-md-12">
                    <label class="mb-0"><strong>@lang('messages.email')</strong></label>
                    <p class="p-txt-color"><?php echo empty($overview->company_email) ? '&nbsp;' : $overview->company_email ?></p>
                </div>
            @endif
            
            @if(in_array($profile_id, $show_price) )
                <div class="col-md-12">
                    <label class="mb-0"><strong>@lang('messages.prices')</strong></label>
                    <p class="p-txt-color">
                        $ <?php echo empty($overview->price_from) ? '&nbsp;' : (int)$overview->price_from ?> @lang('messages.to') $ <?php echo empty($overview->price_to) ? '&nbsp;' : (int)$overview->price_to ?> 
                    </p>
                </div>
            @endif
            
            @if(in_array($profile_id, $show_items) )
                <div class="col-md-12">
                    <label class="mb-0"><strong>@lang('messages.items')</strong></label>
                    <p class="p-txt-color"><?php echo empty($overview->items) ? '&nbsp;' : $overview->items ?></p>
                </div>
            @endif
            
            @if(in_array($profile_id, $show_equipment) )
                <div class="col-md-12">
                    <label class="mb-0"><strong>@lang('messages.equipments')</strong></label>
                    <p class="p-txt-color"><?php echo empty($overview->equipments) ? '&nbsp;' : $overview->equipments ?></p>
                </div>
            @endif

            @if(in_array($profile_id, $show_facilities) )
                <div class="col-md-12">
                    <label class="mb-0"><strong>@lang('messages.facilities')</strong></label>
                    <p class="p-txt-color">
                        <?php 
                            if(isset($overview->facilities)) {
                                $facility = explode(',', \Config::get('global.profile_8_facilities'));
                                $facilities = explode(',', $overview->facilities);
                                $html = '';
                                
                                foreach ($facilities as $key => $value) {
                                    $html = (empty($html) ? "" : $html . ", ") . $facility[$value];
                                }
                                echo empty($html) ? '&nbsp;' : $html;                            
                            }
                        ?>
                    </p>
                </div>
            @endif


            @if(in_array($profile_id, $show_services) )
                <div class="col-md-12">
                    <label class="mb-0"><strong>@lang('messages.services')</strong></label>
                    <p class="p-txt-color"><?php echo empty($overview->services) ? '&nbsp;' : $overview->services ?></p>
                </div>
            @endif
            
                
            @if(in_array($profile_id, $show_genres) )
                <div class="col-md-12">
                    <label class="mb-0"><strong>@lang('messages.genres')</strong></label>
                    <p class="p-txt-color">
                        <?php 
                            if(!empty($overview->genres)) {
                                $gen = explode(',', \Config::get('global.genres'));
                                $genres = explode(',', $overview->genres);
                                $html = '';
                                foreach ($genres as $key => $value) {
                                    $html = (empty($html) ? "" : $html . ", ") . $gen[$value];
                                }
                                echo empty($html) ? '&nbsp;' : $html;                            
                            }
                        ?>
                    </p>
                </div>
            @endif
            
            @if(in_array($profile_id, $show_instruments) )
                <div class="col-md-12">
                    <label class="mb-0"><strong>@lang('messages.instruments')</strong></label>
                    <p class="p-txt-color">
                        <?php 
                            if(!empty($overview->instruments)) {
                                $gen = explode(',', \Config::get('global.instruments'));
                                $instruments = explode(',', $overview->instruments);
                                $html = '';
                                foreach ($instruments as $key => $value) {
                                    $html = (empty($html) ? "" : $html . ", ") . $gen[$value];
                                }
                                echo empty($html) ? '&nbsp;' : $html;                            
                            }
                        ?>
                    </p>
                </div>
            @endif

            @if(in_array($profile_id, $show_influences) )
                <div class="col-md-12">
                    <label class="mb-0"><strong>@lang('messages.influences')</strong></label>
                    <p class="p-txt-color"><?php echo empty($overview->influences) ? '&nbsp;' : $overview->influences ?></p>
                </div>
            @endif
            
            
            @if(in_array($profile_id, $show_special_skills) )
                <div class="col-md-12">
                    <label class="mb-0"><strong>@lang('messages.special_skills')</strong></label>
                    <p class="p-txt-color"><?php echo empty($overview->skills) ? '&nbsp;' : $overview->skills ?></p>
                </div>
            @endif

        </div>
    </div>

    <div class="form-field-area hide">
        {!! Form::open(array('method' => 'post', 'class' => 'form', 'id' => 'overview_form', 'files'=>true)) !!}
            <input type="hidden" name="profile_id" value="{{ $profile_id }}">
            <input type="hidden" name="user" value="{{ $user_profile_id }}">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="button" class="cancel-btn-1" style="">@lang('messages.cancel')</button>
                    <button type="button" id="overview_submit" class="submit-btn-1" style="">@lang('messages.submit')</button>
                </div>
                
                <div class="col-md-12 mb-15">
                    <div class="form-group">
                        {!! Form::label('language_id', \Lang::get('messages.languages'), ['class' => 'bold mb-0']) !!} 
                        {!! Form::select('language_id[]', $languages, (!empty($overview) ? explode(',', $overview->language_id) : ''), array('class'=>'form-control select2', 'multiple' => 'multiple', 'data-maximum-selection-length' => '8', 'data-validate' =>'required,max_selection', 'id'=>'language_id')) !!}
                    </div>
                </div>

                @if(in_array($profile_id, $show_looking_for) )
                    <div class="col-md-12 mb-15">
                        <div class="form-group">
                            {!! Form::label('looking_for', \Lang::get('messages.looking_for'), ['class' => 'bold']) !!}
                            {!! Form::textarea('looking_for', (!empty($overview) ? $overview->looking_for : '') , array('class'=>'form-control', 'rows' => 2, 'data-validate' =>'max:120', 'id'=>'looking_for', 'placeholder'=>'Looking for')) !!}
                        </div>
                    </div>
                @endif
                
                @if(in_array($profile_id, $show_interest) )
                    <?php $interest = \General::getAllInterest(); ?>
                    <div class="col-md-12 mb-15">
                        {!! Form::label('interest', \Lang::get('messages.interested_in'), ['class' => 'bold mb-0']) !!} 
                        {!! Form::select('interest_id[]', $interest, (!empty($overview) ? explode(',', $overview->interest_id) : ''), array('class'=>'form-control select2', 'multiple' => 'multiple')) !!}
                    </div>
                @endif
                
                @if(in_array($profile_id, $show_genres) )
                    <?php $genres = explode(',', \Config::get('global.genres')); ?>
                    <div class="col-md-12 mb-15">
                        {!! Form::label('genres', \Lang::get('messages.genres'), ['class' => 'bold mb-0']) !!} 
                        {!! Form::select('genres[]', $genres, (!empty($overview) ? explode(',', $overview->genres) : ''), array('class'=>'form-control select2', 'multiple' => 'multiple', 'data-maximum-selection-length' => '8', 'data-validate' =>'max_selection' )) !!}
                    </div>
                @endif

                @if(in_array($profile_id, $show_instruments) )
                    <?php $instruments = explode(',', \Config::get('global.instruments')); ?>
                    <div class="col-md-12 mb-15">
                        {!! Form::label('instrument', \Lang::get('messages.instruments'), ['class' => 'bold mb-0']) !!} 
                        {!! Form::select('instruments[]', $instruments, (!empty($overview) ? explode(',', $overview->instruments) : ''), array('class'=>'form-control select2', 'multiple' => 'multiple', 'data-maximum-selection-length' => '8', 'data-validate' =>'max_selection' )) !!}
                    </div>
                @endif


                @if(in_array($profile_id, $show_influences) )
                    <div class="col-md-12 mb-15">
                        <div class="form-group">
                            {!! Form::label('influences', \Lang::get('messages.influences'), ['class' => 'bold']) !!}
                            {!! Form::textarea('influences', (!empty($overview) ? $overview->influences : '') , array('class'=>'form-control', 'rows' => 2, 'data-validate' =>'max:200', 'id'=>'influences', 'placeholder'=>'Influences')) !!}
                        </div>
                    </div>
                @endif

                @if(in_array($profile_id, $show_types) )
                    <div class="col-md-12 mb-15">
                        <div class="form-group">
                            {!! Form::label('types', \Lang::get('messages.types'), ['class' => 'bold']) !!}
                            {!! Form::textarea('types', (!empty($overview) ? $overview->types : '') , array('class'=>'form-control', 'rows' => 2, 'data-validate' =>'max:120', 'id'=>'types', 'placeholder'=>'Types')) !!}
                        </div>
                    </div>
                @endif

                @if(in_array($profile_id, $show_special_skills) )
                    <div class="col-md-12 mb-15">
                        <div class="form-group">
                            {!! Form::label('special_skills', \Lang::get('messages.special_skills'), ['class' => 'bold']) !!}
                            {!! Form::textarea('skills', (!empty($overview) ? $overview->skills : '') , array('class'=>'form-control', 'rows' => 2, 'data-validate' =>'max:120', 'id'=>'skills', 'placeholder'=>'Special skills')) !!}
                        </div>
                    </div>
                @endif

                @if(in_array($profile_id, $show_address) )
                    <div class="col-md-12 mb-15">
                        <div class="form-group">
                            {!! Form::label('address', \Lang::get('messages.address'), ['class' => 'bold']) !!}
                            {!! Form::text('company_address', (!empty($overview) ? $overview->company_address : '') , array('class'=>'form-control', 'data-validate' =>'max:120', 'id'=>'company_address', 'placeholder'=>'Address')) !!}
                        </div>
                    </div>
                @endif
                
                @if(in_array($profile_id, $show_telephone) )
                    <div class="col-md-12 mb-15">
                        <div class="form-group">
                            {!! Form::label('phone', \Lang::get('messages.phone'), ['class' => 'bold']) !!}
                            {!! Form::number('company_telephone', (!empty($overview) ? $overview->company_telephone : '') , array('class'=>'form-control', 'data-validate' =>'numeric', 'id'=>'company_telephone', 'placeholder'=>'Telephone')) !!}
                        </div>
                    </div>
                @endif
                
                @if(in_array($profile_id, $show_email) )
                    <div class="col-md-12 mb-15">
                        <div class="form-group">
                            {!! Form::label('email', \Lang::get('messages.email'), ['class' => 'bold']) !!}
                            {!! Form::email('company_email', (!empty($overview) ? $overview->company_email : '') , array('class'=>'form-control', 'data-validate' =>'email', 'id'=>'company_email', 'placeholder'=>'Email')) !!}
                        </div>
                    </div>
                @endif
                
                @if(in_array($profile_id, $show_price) )
                    <div class="col-md-12 mb-15">
                        <div class="form-group">
                            {!! Form::label('prices', \Lang::get('messages.prices'), ['class' => 'bold']) !!}
                            <div class="input-group">
                                {!! Form::number('price_from', (!empty($overview) ? (int)$overview->price_from : '') , array('class'=>'form-control max-width-20', 'data-validate' =>'numeric', 'id'=>'price_from', 'placeholder'=>'Price')) !!}
                                <label for="" class="bold">@lang('messages.to')</label>
                                {!! Form::number('price_to', (!empty($overview) ? (int)$overview->price_to : '') , array('class'=>'form-control max-width-20', 'data-validate' =>'numeric', 'id'=>'price_to', 'placeholder'=>'Price')) !!}
                                <label for="" class="bold">$</label>
                            </div>
                        </div>
                    </div>
                @endif

                @if(in_array($profile_id, $show_items) )
                    <div class="col-md-12 mb-15">
                        <div class="form-group">
                            {!! Form::label('items', \Lang::get('messages.items'), ['class' => 'bold']) !!}
                            {!! Form::textarea('items', (!empty($overview) ? $overview->items : '') , array('class'=>'form-control', 'rows' => 2, 'data-validate' =>'max:120', 'id'=>'items', 'placeholder'=>'Items')) !!}
                        </div>
                    </div>
                @endif
                
                @if(in_array($profile_id, $show_equipment) )
                    <div class="col-md-12 mb-15">
                        <div class="form-group">
                            {!! Form::label('equipments', \Lang::get('messages.equipments'), ['class' => 'bold']) !!}
                            {!! Form::textarea('equipments', (!empty($overview) ? $overview->equipments : '') , array('class'=>'form-control', 'rows' => 2, 'data-validate' =>'max:120', 'id'=>'equipment', 'placeholder'=>'Equipments')) !!}
                        </div>
                    </div>
                @endif

                @if(in_array($profile_id, $show_facilities) )
                    <?php $facilities = explode(',', \Config::get('global.profile_8_facilities')); ?>
                    <div class="col-md-12 mb-15">
                        {!! Form::label('facilities', \Lang::get('messages.facilities'), ['class' => 'bold mb-0']) !!} 
                        {!! Form::select('facilities[]', $facilities, (!empty($overview) ? explode(',', $overview->facilities) : ''), array('class'=>'form-control select2', 'multiple' => 'multiple' )) !!}
                    </div>
                @endif

                @if(in_array($profile_id, $show_services) )
                    <div class="col-md-12 mb-15">
                        <div class="form-group">
                            {!! Form::label('services', \Lang::get('messages.services'), ['class' => 'bold']) !!}
                            {!! Form::textarea('services', (!empty($overview) ? $overview->services : '') , array('class'=>'form-control', 'rows' => 2, 'data-validate' =>'max:120', 'id'=>'services', 'placeholder'=>'Services')) !!}
                        </div>
                    </div>
                @endif

            </div>
        
        {!! Form::close() !!}
    </div>


<script>
    $('.select2').select2();
    $(document).on('click', '#edit-lang-look-interest', function(e){ //}).click(function(){
        $('.info-area').hide();
        $('.form-field-area').removeClass('hide');
    });
    $(document).on('click', '.cancel-btn-1', function(e) { //}).click(function(){
        $('.info-area').show();
        $('.form-field-area').addClass('hide');
    });
    $(document).on('click', '#overview_submit', function(e) {
        e.preventDefault();
        if(validateRegister($('#overview_form')) == false){
            return false;
        } else {
            // ajax submit
            var form_data = new FormData(document.getElementById("overview_form"));
            $("#v-flip-arrow").removeClass("rotate");
            $(".main-profile-box").removeClass("is-active");

            $('.main-profile-box').html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                url: "{{ route('update.profile.overview') }}",
                type: 'post',
                processData: false,
                contentType: false,
                data: form_data,
                success:function(response) {

                    setTimeout(() => {
                        // Definition of function is in shared->scripts.blade.php
                        loadOverview();
                    }, 200);
                }
            })
        }
    });

    $(document).on('click', ".arrow-down-up", function(e){
        e.stopPropagation();  
        e.preventDefault();      
        $(".main-profile-box").toggleClass("is-active");
        $(this).find("#v-flip-arrow").toggleClass("rotate");
        e.stopImmediatePropagation();  
    });
</script>
