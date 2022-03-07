@extends('frontend.layouts.layout')

@section('content')

    <section class="keypeople-begin-section">

        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-md-6 text-left">
                    <label class="themetextColor"><i class="fa fa-users" aria-hidden="true"></i> KEY PEOPLE</label>
                </div>
                <div class="col-md-6 search-btn-key-p">
                    <form class="searchbtn" action="#" style="width:50%;">
                        <input type="text" id="filter" placeholder="Search.." name="search2" onkeyup="filterkeypeople()">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="button" class="add-category-btn" onclick="openModal('add_key_people_modal', '{{route('add.key.people')}}')">Add
                        Category</button>
                </div>
            </div>
        </div>
    </section>


    <section class="keylist-first-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills mb-3 center-tabs" id="pills-tab" role="tablist">

                        <li class="nav-item keylist-tabs" role="presentation">
                            <a class="nav-link active" id="all-keypeople-tab" data-toggle="pill" href="#all-keypeople" role="tab"
                                aria-controls="all-keypeople" aria-selected="true">All Keypeople</a>
                        </li>

                        @foreach ($keypeople_title as $key => $value)

                            <li class="nav-item keylist-tabs" role="presentation" style="border-color:{{$value->color}}">
                                <a class="nav-link key__list__tab" data-id="{{$value->id}}" id="key-people{{$value->id}}" data-toggle="pill" href="#key_people_{{$value->id}}" role="tab" aria-controls="key_people_{{$value->id}}" aria-selected="true">
                                    {{$value->title}}            
                                </a>
                            </li>
                            
                        @endforeach

                        
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 py-4">
                    <div class="tab-content" id="pills-tabContent">

                        <div class="tab-pane fade show active" id="all-keypeople" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <div class="container-fluid">
                                <div class="row">
                                    @foreach ($keypeople as $key => $item)

                                        <div class="col-md-6 keypeople__block">
                                            <div class="card-box">
                                                <div class="row">
                                                    <div class="col-md-12 col-lg-3">
                                                        <img src="{{ asset('/')}}uploads/profile_picture/{{$item->usersProfile->profile_pic}}"
                                                        class="key-people-card-img">
                                                    </div>
                                                    <div class="col-md-12 col-lg-6 card-spacing">
                                                        <h3 class="key_people_name">{{$item->usersProfile->full_name}} ({{$item->usersProfile->gender == "Male" ? 'M' : ($item->usersProfile->gender == "Female" ? 'F' : 'Nby')}}, {{ $item->usersProfile->age()}})</h3>
                                                        <div class="remove-bottom-space">
                                                        <p>{{ $item->usersProfile->getCity('title') }}, {{ $item->usersProfile->getCountry('title') }}</p>
                                                        <p>0 Mutual Key People </p>
                                                        <p><?php echo \General::countMatchingInterest($item->sender_id, $item->receiver_id); ?> Matching Interests</p>
                                                        <p>0 Contributions</p>
                                                        </div>
                                                    </div>
                                    
                                                    <div class="col-md-12 col-lg-3 card-spacing">
                                                        <div class="pt-2">
                                                            
                                                            <div class="plus-text-area-1">
                                                                <i class="fa fa-plus" aria-hidden="true" onclick="openModal('add_to_key_list', '{{ route('add.to.keylist', ['profile_id' => 0, 'user_profile' => $item->id, 'media_type' => 'KeyPeoples' ])}}' )"></i>
                                                                <p class="add-key-text"><strong>Add to key list</strong></p>
                                                            </div>
                                                        </div>
                                                        <div class="card-content-info">
                                                            <select class="form-control updateCategory custom-select-height" data-keypeople="{{$item->id}}">
                                                                <option value="">Category</option>
                                                                
                                                                @foreach ($keypeople_title as $key1 => $value)
                                                                    <option value="{{$value->id}}" {{($value->id == $item->keypeople_title_id) ? 'selected' : '' }}>{{ $value->title}}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                        <div class="card-content-info">
                                                            <a href="javascript: void(0);" data-toggle="modal" data-target="#write-message"><i
                                                            class="fa fa-comment-o" aria-hidden="true"></i>Message</a>
                                                        </div>
                                    
                                                        <div class="card-content-info">
                                                            <a href="javascript: void(0);" class="delete-keypeople" data-sender="{{ $item->sender_id }}" data-receiver="{{ $item->receiver_id}}"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    @endforeach
                                    
                                  </div>
                            
                            </div>


                        </div>

                        @foreach ($keypeople_title as $key => $value)
                            <div class="tab-pane fade show" id="key_people_{{$value->id}}" role="tabpanel" aria-labelledby="key-list{{$value->id}}">
                                <div class="container-fluid">
                                    <div class="row">
                                        <?php $keypeoples = $keypeople->groupBy('keypeople_title_id'); ?>
                                        @if(!empty($keypeoples[$value->id]))
                                            @foreach ($keypeoples[$value->id] as $k => $item)

                                                <div class="col-md-6 keypeople__block">
                                                    <div class="card-box">
                                                        <div class="row">
                                                            <div class="col-md-12 col-lg-3">
                                                                <img src="{{ asset('/')}}uploads/profile_picture/{{$item->usersProfile->profile_pic}}"
                                                                class="key-people-card-img">
                                                            </div>
                                                            <div class="col-md-12 col-lg-6 card-spacing">
                                                                <h3 class="key_people_name">{{$item->usersProfile->full_name}} ({{$item->usersProfile->gender == "Male" ? 'M' : ($item->usersProfile->gender == "Female" ? 'F' : 'Nby')}}, {{ $item->usersProfile->age()}})</h3>
                                                                <div class="remove-bottom-space">
                                                                <p>{{ $item->usersProfile->getCity('title') }}, {{ $item->usersProfile->getCountry('title') }}</p>
                                                                <p>0 Mutual Key People </p>
                                                                <p><?php echo \General::countMatchingInterest($item->sender_id, $item->receiver_id); ?> Matching Interests</p>
                                                                <p>0 Contributions</p>
                                                                </div>
                                                            </div>
                                            
                                                            <div class="col-md-12 col-lg-3 card-spacing">
                                                                <div class="pt-2">
                                                                    <div class="plus-text-area-1">
                                                                        <i class="fa fa-plus" aria-hidden="true" onclick="openModal('add_to_key_list', '{{ route('add.to.keylist', ['profile_id' => 0, 'user_profile' => $item->id, 'media_type' => 'KeyPeoples' ])}}' )"></i>
                                                                        <p class="add-key-text"><strong>Add to key list</strong></p>
                                                                    </div>
                                                                </div>
                                                                <div class="card-content-info">
                                                                    <select class="form-control updateCategory custom-select-height" data-keypeople="{{$item->id}}">
                                                                        <option value="">Category</option>
                                                                        
                                                                        @foreach ($keypeople_title as $key1 => $value)
                                                                            <option value="{{$value->id}}" {{($value->id == $item->keypeople_title_id) ? 'selected' : '' }}>{{ $value->title}}</option>
                                                                        @endforeach

                                                                    </select>
                                                                </div>
                                                                <div class="card-content-info">
                                                                    <a href="javascript: void(0);" data-toggle="modal" data-target="#write-message"><i
                                                                    class="fa fa-comment-o" aria-hidden="true"></i>Message</a>
                                                                </div>
                                            
                                                                <div class="card-content-info">
                                                                    <a href="javascript: void(0);" class="delete-keypeople" data-sender="{{ $item->sender_id }}" data-receiver="{{ $item->receiver_id}}"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    {!! Form::open(array('method' => 'post', 'class' => 'form', 'id' => 'delete_key_people_form', 'files'=>false)) !!}    
        <input type="hidden" name="sender" id="sender__id" >
        <input type="hidden" name="receiver" id="receiver__id" >
    {!! Form::close() !!}

    @include('frontend.keypeople.add_title_modal')

    @include('frontend.keylist.shared.keylist_modal')

    @push('custom-script')
        <script>

            function filterkeypeople() {
                var input, filter, ul, li, a, i, txtValue;
                input = $("#filter");
                filter = input.val().toUpperCase();
                // ul = $(".keypeople_ul");
                li = $(".keypeople__block");
                for (i = 0; i < li.length; i++) {
                    a = li[i].getElementsByClassName("key_people_name")[0];
                    txtValue = a.textContent || a.innerText;
                    console.log(txtValue);
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        li[i].style.display = "";
                    } else {
                        li[i].style.setProperty("display", "none", "important");
                    }
                }
            }

            $(document).on('click', '.delete-keypeople', function(e) {

                $('#delete_key_people_form').attr("action", "{{route('delete.keypeople')}}")
                $('#sender__id').val($(this).attr('data-sender'));
                $('#receiver__id').val($(this).attr('data-receiver'));
                if(confirm('Are you sure you want to delete the keypeople?')) {
                    $('#delete_key_people_form').submit();
                }
            });


            $(document).on('change', '.updateCategory', function(e) {
                var cat = $(this).val();
                var keypeople = $(this).attr('data-keypeople');
                $.ajax({
                    url: "{{route('update.keypeople.category')}}",
                    type: 'post',
                    data: {'keypeople_title_id': cat, 'keypeople_id': keypeople, '_token': "{{csrf_token()}}" },
                    success:function(response) {
                        location.reload(true);
                    }
                });
            });
        </script>
        
    @endpush
@endsection
