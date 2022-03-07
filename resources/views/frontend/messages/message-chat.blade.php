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
                            <li class="breadcrumb-item active" aria-current="page">Message Chat Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="keypeople-begin-section px-1">
        <div class="container">
            <div class="row header-area">
                <div><i class="fa fa-comments" aria-hidden="true"></i>&nbsp;MESSAGES</div>
                   <!--  <div><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;Write Message</div> -->
            </div>  
        </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach($chat_history as $key => $value)
                    <?php
                        // if(!in_array(Auth::guard('user')->user()->id, explode(',', $value->deleted_by))) {
                        //     if($value->is_msg_from_admin) {
                        //         $bAdmin = true;
                        //     }
                        //     // print_r($value->is_group_msg); die();
                        //     //$user_details;
                        //     $imgname_split = explode('/',$value->profile_pic);
                        //     if($value->is_group_msg == 1) {
                        //         $user_details = General::getUserDetail($value->sender_id);
                        //         $imgname_split = explode('/',$user_details->profile_pic);
                        //     }
            
                        //     $user_name = $value->is_group_msg == 1 ? $user_details->full_name : $value->full_name;
                        //     $redirect_url = route('main', ($value->is_group_msg == 1 ? $user_details->id : $value->sender_id) );
                        
                        //     $seen_by = '';
                        
                        //     if($value->is_group_msg == 1) {
                        //         if(!empty($value->group_msg_read_by) && Auth::guard('user')->user()->id == $value->sender_id ) {
                        //             $usr = General::getUsers($value->read_by, Auth::guard('user')->user()->id);
                        //             if(!empty($usr)) {
                        //                 $seen_by = '<i class="fa fa-check"></i> Seen by ' .$usr;
                        //             }
                        //         }
                        //     } else {
                        //         // if($value->is_read_msg == 1 && Auth::guard('company')->user()->id != $value->to_user_id) {
                        //         //     $usr = DataArrayHelper::getUserDetail($value->to_user_id);
                        //         //     $seen_by = '<i class="fa fa-check"></i> Seen by ' .$usr->name;
                        //         // }
                        //     }
                        //     $mkpBorder = (Auth::guard('user')->user()->id == $value->sender_id ? "mkp__border" : "");
                        //     $is_msg_from_project_application = ($value->is_msg_from_project_application == 1 ? 'mkp_blue' : '');

                        //     $img__url = config('app.app_url') . 'jobsportal/public/images/register/' . $imgname_split[count($imgname_split) - 1];
                        //     if($value->is_msg_from_admin) {
                        //         $img__url = $value->profile_pic;
                        //     }
                        // }

                    ?>
                    <div class="message-card">
                        <div class="card-body">
                            <div class="msg-date">
                                <span> {{ date('d-m-Y h:i:s A', strtotime($value->created_at)) }}</span>
                            </div>
                            <div>
                                <div class="chat-img-msg-details">
                                    <div>
                                        <img src="{{ asset('/')}}uploads/profile_picture/{{$value->profile_pic}}" class="chat-img-msg-de" >
                                    </div>
                                    <div class="txt-info-c-msg-details">
                                        <h6 class="mb-0">{{ $value->full_name }}</h6>
                                        <p class="mb-1">{{ $value->subject }}</p>
                                        <span>{{ $value->body }}</span>
                                    </div>
                                </div>
                                <div class="seen-by">
                                    <p><i class="fa fa-check"></i> {{ $value->read_by }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="reply_message">
                    {!! Form::open(array('method' => 'post', 'route' => 'send.message', 'class' => 'form', 'id' => 'send_message', 'files'=>true)) !!}
                        <div class="msg-chat-box">
                            <input type="hidden" name="users_id[]" value="{{ Auth::guard('user')->user()->id }}" />
                            <input type="hidden" name="redirect_url" id="redirect_url" value=""/>
                            <input type="hidden" name="subject" id="subject" autocomplete="off" value="" placeholder="Subject" />

                            <textarea class="message-txt form-control" name="body"></textarea>
                            <div class="chat-file-upload-ara">
                                <div class="add_more_file my-4">
                                    <input type="file" name="attachment[0]" class="mb-4" />
                                </div>
                                <p class="add-more-a-link" style="cursor:pointer;">Click to add more attachments</p>
                                <button class="my-3 send-msg-btn">Send Message</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div> 
        </div>
    </section>

@endsection

@push('custom-style')
    <style type="text/css">

        .reply_message {
            /*padding: 35px 30px;*/
            width: 100%;
            /*margin: 20px 0px 20px 0px;*/
            box-shadow: 0px 0px 6px #ddd;
            /*border-radius: 8px;*/
            border: 1px solid #ddd;
            /*background: #eee;*/
        }

        .upload_block {
            float: right;
            text-align: right;
        }
        .upload_block input[type="file"] {
            direction: rtl;
        }

    </style>
@endpush

@push('custom-script')

    <script type="text/javascript">
        $(document).ready(function(){
            $(".add-more-a-link").click(function(){
                //$(".add_more_file").eq(0).clone().insertAfter(".add_more_file:last");
                var cnt = $(this).data('id');
                cnt++;
                $('.add_more_file').append('<input type="file" name="attachment['+cnt+']" class="mb-4" />')
            });
        });

        $('.add_more').on('click', function(e) {
            e.preventDefault();
            var cnt = $(this).data('id');
            cnt++;
            $('.add_more_file').append('<input type="file" name="attachment['+cnt+']" class="mb-4" />')
        });

    </script>

@endpush