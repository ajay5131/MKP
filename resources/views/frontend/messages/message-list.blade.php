@extends('frontend.layouts.layout')

@section('content')

    <section class="team-list-s-f-1">
        <div class="container">
            <div class="row row-align-center">
                <div class="col-md-6 pl-0">
                    <h2 class="page-heading">Message</h2>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Message</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="keypeople-begin-section">
        <div class="message-box">
            <div class="header-chat">
                <div class="container">
                    <div class="row header-area">
                        <div><i class="fa fa-comments" aria-hidden="true"></i>&nbsp;MESSAGES</div>
                        <div data-toggle="modal" data-target="#write-message-modal" class="write-message"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;Write Message</div>
                    </div>
                </div>
            </div>
            <div class="search-top-msg">
                <input type="text" id="filter_contacts" placeholder="Search" onkeyup="filterContacts()">
            </div>
            <div class="list-people">
                <ul class="people-contact">
                    @foreach($messages as $key => $value)
                    <?php //print_r($value); die(); ?>
                    <?php
                        // if($value->is_group_msg == 1){
                        //     $user_details = \General::getUserDetail($value->full_name);
                        // }
                    ?>
                    <?php
                        //$last_msg = \General::getLastMsg($value->users_id, Auth::guard('user')->user()->id);
                        //print_r($last_msg); die();
                        // if($value->is_group_msg == 1) {
                        //     $last_msg = \General::getGroupLastMsg($value->profile_pic);
                        // } 
                    ?>
                    <?php
                        // if(!empty($last_msg) && !in_array(Auth::guard('user')->user()->id, explode(",", $last_msg->deleted_by))){
                        //     $bGray = false;
                        //     if($last_msg->sender_id != Auth::guard('user')->user()->id) {
                        //         if($last_msg->is_group_msg == 1) {
                        //             if(!in_array(Auth::guard('user')->user()->id, explode(',', $last_msg->read_by))) {
                        //                 $bGray = true;
                        //             }   
                        //         } else {
                        //             if(Auth::guard('user')->user()->id == $last_msg->receiver_id) {
                        //                 $bGray = true;
                        //             }
                        //         }
                        //     } ?>
                            <li class="person-list-item-li">
                                <a class="overlay-link" href="{{ route('messages.chat', ['id' => ($value->is_group_msg == "1" ? $value->profile_pic : $value->users_id), 'type' => \base64_encode($value->is_group_msg) ]) }}"></a>
                                <div class="list-info-msg-chat">
                                    <div class="col-md-1">
                                        <?php //$imgname_split = ($value->is_group_msg == "1" ? explode('/', $user_details->profile_pic) : explode('/',$value->profile_pic)); ?>
                                        @if($value->receiver_id == "default.png")
                                            <img src="{{ asset('/')}}home/images/{{$value->profile_pic}}" class="msg-chat-list-img" >
                                        @else
                                            <img src="{{ asset('/')}}uploads/profile_picture/{{$value->profile_pic}}" class="msg-chat-list-img" >
                                        @endif
                                        @if ($value->is_group_msg != "1")
                                            <span class="time {{ Cache::has('online-' . $value->users_id) ? 'online' : 'offline' }} online"><i class="fa fa-circle"></i></span>
                                        @endif
                                    </div>
                                    <div class="col-md-9 cursor-pointer search_div">
                                        <span class="name">
                                            <!-- @php
                                                if($value->is_group_msg == "1") {
                                                    $users_d = \General::getUserName();
                                                }
                                            @endphp -->
                                            <span class="users_name">{{ $value->is_group_msg == "1" ? $user_details->name . ', ' . $users_d  : $value->full_name}}</span> 
                                            ({{ $value->is_group_msg == "1" ? (\General::getGroupMsgCount($value->profile_pic) - \General::getDeletedGroupMsgCount($value->profile_pic, Auth::guard('user')->user()->id)) : (\General::getMsgCount($value->users_id, Auth::guard('user')->user()->id) - \General::getDeletedMsgCount(Auth::guard('user')->user()->id, $value->users_id) ) }})
                                        </span>
                                        
                                        <p><b>{{ $value->subject}}</b></p>
                                        <p><?php echo substr($value->body, 0, 250) ?></p>
                                    </div>
                                    <div class="col-md-2 text-right date-close-right">
                                        <p class="last_msg_dt">{{  date('d-m-Y', strtotime($value->created_at)) }}</p>
                                        <p class="last_msg_dt delete_msgs cursor-pointer" onclick="deleteMsgs({{ ($value->is_group_msg == '1') ? $value->profile_pic  : $value->users_id}}, '{{$value->is_group_msg}}')"><span class="fa fa-times"></span></p>
                                    </div>
                                    <!-- <div class="col-md-9">
                                        <span class="msg-chat-text-name">
                                            <span class="users_name">{{ $value->full_name }}</span> (5)
                                        </span>
                                        <p>{{ $value->subject }}</p>
                                    </div> -->
                                    <!-- <div class="col-md-2 text-right date-close-right">
                                        <p class="last_msg_dt">22-09-2021</p>
                                        <p class="last_msg_dt delete_msgs cursor-pointer" onclick=""><span class="fa fa-times"></span></p>
                                    </div> -->
                                </div> 
                            </li>
                        <?php //} ?>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <!-- Modal  Start Profile Pic update -->
    <div class="modal fade" id="add_note_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateprofilepicModalLabel">Add Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <p>add note upto 22 characters</p>
                        <textarea class="form-control set-h-textarea"></textarea><br>
                        <h6>Choose background color</h6>
                        <input type="color" id="favcolor" name="favcolor" value="#18789c">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-btn-color">Add </button>
                    <button type="button" class="btn btn-secondary bgred" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->

    <!-- Modal  Start Profile Pic update -->
    <div class="modal fade" id="add_key_list_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title themetextColor" id="updateprofilepicModalLabel">Add New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <input class="form-control" placeholder="Category Name"><br>
                        <h6 class="themetextColor">Choose background color</h6>
                        <input type="color" id="favcolor" name="favcolor" value="#18789c">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-btn-color btn-lg btn-block">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->

    <!-- Modal  Start Profile Pic update -->
    <div class="modal fade" id="edit_key_list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title themetextColor" id="updateprofilepicModalLabel">Edit Key List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <input class="form-control" placeholder="My Media"><br>
                        <h6 class="themetextColor">Choose background color</h6>
                        <input type="color" id="favcolor" name="favcolor" value="#18789c">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-btn-color btn-lg btn-block">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->
    <!-- Modal  Start To your feed  -->
    <div class="modal fade" id="to_your_feed" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateprofilepicModalLabel">Add Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <textarea class="form-control"  placeholder="Add Your message (optional)" row="10"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-btn-color btn-color-w">Share </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->

    <!-- Modal  Start To your feed  -->
    <div class="modal fade" id="to_key_people" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateprofilepicModalLabel">Write Messages</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group text-left bg-blue-light">
                        <label class="modal-label px-10"><strong>SEND MESSAGE TO CONTACT(S)</strong></label>
                        <input type="text" class="form-control mx-10" placeholder="Search">
                        <p class="p-all-10 px-10">No Contact found !</p>
                        <button type="button" class="btn bg-btn-color btn-color-w btn-lg btn-block abs-btn">Submit</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-btn-color btn-color-w">Send</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->

    <!-- Modal  Start To your feed  -->
    <div class="modal fade" id="add_url" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title themetextColor" id="updateprofilepicModalLabel">Add URL</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <input class="form-control" placeholder="Enter a URL"><br>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn bg-btn-color">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->

    <!-- Modal  Start Add to key list  -->
    <div class="modal fade" id="add_to_key_list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index:9999;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateprofilepicModalLabel">Add to Key List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Add New List" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary outline-btn" type="button">
                                <i class="fa fa-plus-circle plus-circle" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-check text-left check-field-center">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option2">
                        <label class="form-check-label" for="exampleRadios1">
                            New Crew
                        </label>
                    </div>
                    <div class="form-check text-left check-field-center">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                        <label class="form-check-label" for="exampleRadios2">
                            Must Watch 
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn bg-btn-color btn-color-w">Save </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->

    <!-- Modal  Start Add to key list  -->
    <div class="modal fade bd-example-modal-lg" id="write-message" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index:9999;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header change-bg-header">
                    <h5 class="modal-title">Write Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12 py-1">
                                    <input type="text" name="" class="form-control" placeholder="subject"> 
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-md-12 py-1">
                                    <textarea class="form-control" placeholder="Message"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div  class="col-md-12 py-2 text-left">
                                    <input type="file" name="" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 py-2 text-left">
                                    <p class="cur-point">Click to add More attachments</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="message-chat-box">
                                <div class="msg-chat-head-title">
                                    <h4>Send Message To Contact(s)</h4>
                                </div>
                                <div class="list-of-people">
                                    <ul class="list-people-item">
                                        <li>
                                            <i class="fa fa-circle offline-circel" aria-hidden="true"></i>
                                            <img src="https://www.meetkeypeople.com/jobsportal/public/images/register/1624389420.png" class="chat-msg-img">
                                            <span class="name">Rotthyda </span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="msg-chat-footer-btn">
                                    <button type="button" class="btn add-more">Add More </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn bg-btn-color btn-color-w">Save </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="write-message-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background:#eee;">
                    <h5 class="modal-title" >Write Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- <form class="form-horizontal" action="{{ route('send.message') }}"  method="POST" id="send_message" enctype="multipart/form-data"> -->
                {!! Form::open(array('method' => 'post', 'route' => 'send.message', 'class' => 'form', 'id' => 'send_message', 'files'=>true)) !!}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="col-md-12 py-2">
                                    <input type="hidden" name="is_from_project_applocation" id="is_from_project_applocation" value="0" />
                                    <input type="hidden" name="redirect_url" id="redirect_url" value="" />
                                    <input type="text" name="subject" class="form-control" placeholder="Subject">
                                </div>
                                <div class="col-md-12 py-2">
                                    <textarea class="form-control text-area-msg" name="body" placeholder="Message"></textarea>
                                </div>
                                <div class="col-md-12 add_more_files py-2 text-left">
                                    <input type="file" name="attachment[0]" class="fileclone mb-4">
                                </div>
                                <div class="col-md-12 py-2 text-left">
                                    <p class="add_more" style="cursor:pointer;">Click to add more attachments</p>
                                    <!-- <a href="javascript:;" class="add_more" data-id="1">Click to add more attachments</a> -->
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="header-msg">
                                    <div class="grey-header">
                                        SEND MESSAGE TO CONTACT(S)
                                    </div>
                                    <div class="grey-body add_more_contact" style="display: none">
                                        <div class="top">
                                            <input type="text" id="filter_contacts1" placeholder="Search" onkeyup="addmorefilterContacts()" />
                                        </div>

                                        <ul class="people addmore_contacts">
                                            <?php $usersProfile = \General::getUserName(); ?>

                                            @foreach ($usersProfile as $key => $value)
                                                @if($value->user_role_id != "1")
                                                    @php
                                                        $user_details = \General::getUserDetail($value->full_name);
                                                    @endphp
                                                    <li class="person contact_list_{{ $value->users_id }}" data-chat="person1" data-typ="">
                                                        <?php $imgname_split = explode('/',$value->profile_picture_uri); ?>

                                                        @if($value->profile_pic == "default.png")
                                                            <img src="{{ asset('/')}}home/images/{{$value->profile_pic}}" class="my-profile-img" >
                                                        @else
                                                            <img src="{{ asset('/')}}home/images/{{$value->profile_pic}}" class="my-profile-img" >
                                                        @endif                                                
                                                        
                                                        <span class="name">{{ $value->full_name}} </span>                                                    
                                                    </li>
                                                
                                                @endif
                                            @endforeach
                                        </ul>
                                        <?php //$usersProfile = \General::getUserName(); ?>
                                       <!--  @foreach ($usersProfile as $key => $value)
                                        <li>
                                            <span>{{ $value->full_name }}</span>
                                        </li>
                                        @endforeach -->
                                    </div>

                                    <div class="list_people lstpeople">
                                        <ul class="people add_persons">
                                            
                                        </ul>
                                    </div>

                                    <div class="add_contact_button">
                                        <button type="button">Add More</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-theme">Send</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@push('custom-style')
    <style type="text/css">

        .overlay-link{
            position: absolute;
            width: 90%;
            height: 100%;
            top: 0;
            z-index: 99;
            left: 0;
        }

        .top input {
            height: 34px;
            background: #fff !important;
        }

        .top input {
            float: left;
            width: 100%;
            height: 38px;
            padding: 0 55px 0 20px;
            border: 1px solid #ddd;
            border-radius: 20px !important;
            /* font-family: "Source Sans Pro", sans-serif; */
            font-weight: 400;
            margin-bottom: 0;
        }
        .top input:focus {
            outline: none;
        }
        .top a.search {
            display: block;
            float: left;
            width: 40px;
            height: 40px;
            margin-left: 10px;
            border: 1px solid var(--light);
            background-color: var(--blue);
           
            border-radius: 50%;
            color: #fff;
            font-size: 20px;
            position: absolute;
            right: 32px;
            margin-top: 1px;
            padding: 2px 10px;
        }

        .list_people {
            /* min-height: calc(100vh - 440px); */
            min-height: 290px;
            max-height: 320px;
        }
        .add_more_contact {
            position: absolute;
            width: 90%;
            height: 290px;
            overflow-y: auto;
            z-index: 99;
            background: #ddd;
        }

        .list_people::-webkit-scrollbar .messages-chat::-webkit-scrollbar .add_more_contact::-webkit-scrollbar {
            width: 4px;
        }

        .list_people::-webkit-scrollbar .messages-chat::-webkit-scrollbar-track .add_more_contact::-webkit-scrollbar-track {
            box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.14);
        }
        
        .list_people::-webkit-scrollbar .messages-chat::-webkit-scrollbar-thumb .add_more_contact::-webkit-scrollbar-thumb {
            background-color: #18789c;
        }

        .top {
            padding: 5px 20px 5px 12px;
            height: 48px;
        }

        .add_contact_button button {
            width: 101%;
            height: 50px;
            margin-right: -2px;
            background: #eee;
            color: #000;
            border: 1px solid #18789c;
        }

        .add_more_contact .people .person {
            position: relative;
            width: 100%;
            padding: 6px 5% 14px !important;
            cursor: pointer;
            transition: all 0.5s;
            border-top: 1px solid #ccc;
            margin-bottom: 5px;
            height: 55px;
        }

        .people .person img {
            float: left;
            width: 41px;
            height: 42px;
            margin-right: 12px;
            /* border-radius: 50%; */
            -o-object-fit: cover;
            object-fit: cover;
        }

        .people .person .name {
            font-size: 18px;
            /*line-height: 42px;*/
            color: var(--dark);
            font-weight: 500;
            float: left;
        }

        .people .person .time {
            font-size: 14px;
            position: absolute;
            top: 36px;
            left: -73%;
            padding: 0 0 5px 5px;
            color: var(--grey);
        }
        .online {
            color:green !important;
        }
        .offline {
            color:red !important;
        }

        .people .person.active, .people .person:hover {
            background-color: #18789c;
        }
        .people .person.active span, .people .person:hover span {
            color: var(--white);
            background: transparent;
        }
        .people .person.active:after, .people .person:hover:after {
            display: none;
        }

        .person.add_persons.active, .person.add_persons:hover {
            background: transparent
        }
        .person.add_persons.active span,  .person.add_persons:hover span {
            color: var(--dark)
        }

        /*.lstpeople {
            padding: 6px 5% 14px !important;
            height: 55px;
        }*/
        /*.lstpeople {
            max-height: 400px;
            min-height: 400px;
            overflow-y: scroll;
            width: 100%;
        }*/

        .lstpeople .people .person {
            padding: 6px 5% 14px !important;
            height: 55px;
        }

        .left .people .person:after {
            position: absolute;
            bottom: 0;
            left: 50%;
            display: block;
            width: 80%;
            height: 1px;
            content: "";
            transform: translate(-50%, 0);
        }
        ul {
          list-style-type: none;
        }
    </style>
@endpush
@push('custom-script') 

    <script type="text/javascript">

        $('.add_more').on('click', function(e) {
            e.preventDefault();
            var cnt = 1;
            cnt++;
            $('.add_more_files').append('<input type="file" name="attachment['+cnt+']" class="fileclone mb-4" />')
        });

        function addmorefilterContacts() {
            $('#no_contact_found1').hide();
            var input, filter, ul, li, a, i, txtValue;
            input = $("#filter_contacts1");
            filter = input.val().toUpperCase();
            ul = $(".addmore_contacts");
            li = ul.find(".person");
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByClassName("name")[0];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
            if($(".addmore_contacts li:visible").length == 0) {
                $('#no_contact_found1').show();
            }
        }

        $('.add_contact_button').click(function(e) {
            e.preventDefault();
            if($(this).find('button').text() == "Add More") {
                $(this).find('button').text("Submit");
                $('.add_more_contact').slideDown();
            } else {
                $(this).find('button').text("Add More");
                $('.add_more_contact').slideUp();
            }
        });

        $('.add_more_contact').find('.person').click(function(e) {
            // console.log("type", $(this).data('typ'));
            var list_id = $(this).attr('class').split(' ').pop();

            if($(this).data('typ') == "group") {
                $('.add_more_contact').find('.person').removeClass('hide');
                $(".add_persons").empty();
                $('#group_id').val(list_id);
                $('.add_contact_button').find('button').text("Add More");
                $('.add_more_contact').slideUp();
            } else {
                if($('#group_id').val() != "") {
                    $('.' + $('#group_id').val()).removeClass('hide');
                    $('#group_id').val("");
                    $('.add_persons').empty();
                }
            }
            $('.'+list_id).clone().appendTo(".add_persons");
            $('.add_persons').find('.'+ list_id).append("<input name='users_id[]' value='"+list_id+"' type='hidden'>");

            $(this).addClass('hide');

        });

        $('#send_message').submit(function(e) {
           
            if($('#subject').val() == "") {
                alert("Please enter subject!")
                return false;
            }
            if($('#msg_body').val() == "") {
                alert("Please enter message!")
                return false;
            }
            if($('input[name="users_id[]"]').length == 0) {
                alert("Please add one or more contact!")
                return false;
            }

            return true;
        });

        function deleteMsgs(u_id, typ) {
            //alert(u_id);
            // alert(typ);
            var confrm = confirm("Are you sure you want to delete this conversation?");
            if(confrm) {
                $.ajax({
                    type: "post",
                    url: "{{  route('delete.messages') }}",
                    data: {user_id: u_id,_token:"{{csrf_token()}}", typ: typ},
                    success: function(data) {
                        // console.log(data);
                        alert('Message deleted successfully')
                        location.reload(true);
                    }
                });
            }
        }

    </script>

@endpush