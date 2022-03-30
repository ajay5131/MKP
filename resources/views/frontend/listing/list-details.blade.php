@extends('frontend.layouts.layout')

@section('content')


<section id="project-details-sec-1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 d-flex align-v-center">
                <h2 class="we-are-look-for-txt mb-0">We are Looking for :</h2>
                <span class="required-role">{{ $project->title ?? '' }}</span>
            </div>
        </div>

    </div>
</section>
<section id="project-details-sec-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 text-center">
                <h2 class="mb-0">LISTING </h2>

            </div>
            <div class="col-md-6 text-center">
                <h2 class="mb-0">Status :
                    {{ \Carbon\Carbon::parse($project->from_date)->format('d-m-Y') ?? '' }}
                </h2>

            </div>
        </div>

    </div>
</section>
<section id="banner-sec-3">
    <img src="">
    <div class="container-fluid banner-posted-details">
        <img src="https://www.meetkeypeople.com/jobsportal/images/projects/1624397667.png" class="bann-img-details-page">
        <div class="row">

            <div class="col-md-2 text-right right-side-box">
                <div class="plus-text-area">
                    <i class="fa fa-plus plus-icon plus-right-al" aria-hidden="true" data-toggle="modal" data-target="#add_to_key_list"></i>
                </div>
                <p class="text-center bg-btn-col">Add to key list</p>
                <div class="d-flex text-right right-align">
                    <div class="dropdown show">
                        <a class="btn btn-secondary dropdown-toggle dropdown-arrow f-w-m" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Share Listing
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#to_your_feed">To your
                                Feed</a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#to_key_people">To a Key
                                People</a>
                            <a class="dropdown-item" href="#">Copy Link</a>
                        </div>
                    </div>

                    <div class="btn-group dropleft">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            ...
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('list.edit', $project->id) }}">Edit Listing </a>
                            <a class="dropdown-item" href="#">Archive Project</a>
                            <a class="dropdown-item" href="#">Delete Project</a>
                            <a class="dropdown-item" href="#">Sent to Crowdfunding</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="llc-sec">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="llc-txt">

                    <div class="row">
                        <div class="col-md-11 text-center">
                            <h3>{{ $project->title ?? '' }}</h3>
                        </div>
                        <div class="col-md-1 text-right un-lock-area">
                            <i class="fa fa-unlock-alt un-lock" aria-hidden="true" data-toggle="modal" data-target="#unlock-llc"></i>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="label-item">
                    <label>{{ \General::getSingleRow('project_type', 'project_type', $project->project_type_id, 'project_type_id') }}</label>
                    <label>{{ \General::getSingleRow('languages', 'language', $project->language_id) }}</label>
                    <label>{{ \General::getSingleRow('city', 'title', $project->city_id) }}</label>
                </div>

            </div>
        </div>
    </div>
</section>
<section id="b-descript-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">

            </div>
            <div class="col-md-3">
                <!-- <div class="plus-icons-modal" data-toggle="modal" data-target="#add_social_media">
                    <i class="fa fa-plus plus-fa" aria-hidden="true"></i>
                </div> -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <div class="description-box">
                            <h5>Description</h5>
                            <p>{{ $project->title ?? '' }}</p>
                            @if (!$project_tags->isEmpty())
                            @foreach ($project_tags as $key => $tag)
                            <span class="badge badge-primary-{{ $key + 1 }}">{{ $tag->project_tag ?? '' }}</span>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>


                <div class="job-location" style=" margin-bottom: 20px;
                    padding-left: 14px;
                    /* border: 2px solid #18789c; */
                    margin-top: 35px;
                    border-radius: 10px;
                    padding-bottom: 10px;">
                    <h3 style="color: #18789c">Compensation</h3>
                    <i class="fa fa-usd" aria-hidden="true"></i><span> {{$project->salary ?? ""}} </span>
                </div>
                
                <div class="row py-4">
                    <div class="col-md-4">
                        <img src="{{ asset('uploads/' . $project->additional_images) }}" class="grid-layout-item">
                    </div>
                </div>



            </div>
            <div class="col-sm-3" style="padding-right: 0;">

                <figure class="advertiser" style="max-width: 271px;float: right;width:70%;margin-right:-15px;margin-top:0px;">
                    <span style="font-size: 10px;">Posted on the 20-08-2021 by:</span>
                    <a href="https://meetkeypeople.com/main-profile/137" target="_blank">
                        <div class="image">
                            <img src="https://www.meetkeypeople.com/jobsportal/public/images/register/1624389420.png" style="max-height: 205px !important;">
                        </div>
                    </a>
                    <div class="search__details text-left">
                        <a href="https://meetkeypeople.com/main-profile/137" target="_blank">
                            <p class="title">
                                Iola Nguyen
                                (F, 30)
                            </p>
                        </a>

                        <p class="company_profession">Ceo &amp; Founder</p>
                        <p class="location_detail"><i class="la la-map-marker"></i> London,
                            <!-- London -->U.K
                        </p>

                        <a href="javascript:;" data-toggle="modal" data-target="#reviewModal" onclick="getReviews(137, &quot;main&quot;)">
                            <div class="row pl-0">
                                <div class="col-md-10">
                                    <span class="company_review_title">
                                        <i class="la la-file-text-o"></i> Reviews&nbsp;&nbsp; <i class="la la-star"></i>&nbsp;&nbsp;<span class="review_perc"></span>
                                    </span>
                                </div>
                                <div class="col-md-2 pl-0">
                                    <span class="review_count">0</span>
                                </div>
                            </div>
                        </a>
                        <a href="https://meetkeypeople.com/posted-projects?user=137&amp;typ=contributions" target="_blank">
                            <div class="row pl-0">
                                <div class="col-md-10">
                                    <span class="company_review_title">
                                        <i class="la la-folder-open-o"></i> Contributions&nbsp;&nbsp;
                                    </span>
                                </div>
                                <div class="col-md-2 pl-0">
                                    <span class="review_count">0</span>
                                </div>
                            </div>
                        </a>
                        <div class="row pl-0">
                            <div class="col-md-10">
                                <span class="company_review_title">
                                    <i class="la la-diamond"></i> MKP Score&nbsp;&nbsp;
                                </span>
                            </div>
                            <div class="col-md-2 pl-0">
                                <span class="review_count">0</span>
                            </div>
                        </div>

                    </div>
                </figure>

            </div>
        </div>
    </div>
</section>


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
                <textarea class="form-control" placeholder="Add Your message (optional)" row="10"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-btn-color btn-color-w">Share </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->

<!-- Modal  Start Add to key list  -->
<div class="modal fade" id="add_to_key_list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
<div class="modal fade bd-example-modal-lg" id="unlock-llc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-left light-grey-header">
                <h5 class="modal-title" id="">Visibility</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-11 text-left">
                        <span style="font-weight: bold;">Public</span>
                        <p>Anyone can access</p>
                    </div>
                    <div class="col-md-1">
                        <input type="radio" class="visibiltyRadio" name="visibilty" value="1">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-11 text-left">
                        <span style="font-weight: bold;">Private</span>
                        <p>Only your key people can access</p>
                    </div>
                    <div class="col-md-1">
                        <input type="radio" class="visibiltyRadio" name="visibilty" value="2">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-11 text-left">
                        <span style="font-weight: bold;">Secret</span>
                        <p>Only you, anyone tagged or with the URL can access</p>
                    </div>
                    <div class="col-md-1">
                        <input type="radio" class="visibiltyRadio" name="visibilty" value="3">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-11 text-left">
                        <span style="font-weight: bold;">VIP</span>
                        <p>Only you and anyone with Red Badge can access</p>
                    </div>
                    <div class="col-md-1">
                        <input type="radio" class="visibiltyRadio" name="visibilty" value="4">
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Modal End -->

<!-- Modal Start   -->
<div class="modal fade" id="add_social_media" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateprofilepicModalLabel"> Add Social Media </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="col-md-12 text-left py-4">
                    <label>
                        <img class="social_icon" src="https://staticsn.com/images/icons/svg/facebook-square.svg">
                        Facebook
                    </label>
                    <input type="text" name="" class="form-control">
                </div>
                <div class="col-md-12 text-left py-2">
                    <label>
                        <img class="social_icon" src="https://staticsn.com/images/icons/svg/youtube-square.svg">
                        Youtube
                    </label>
                    <input type="text" name="" class="form-control">
                </div>
                <div class="col-md-12 text-left py-2">
                    <button type="button" class="btn bg-btn-color btn-color-w btn-lg btn-block">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->


<!-- Modal  Start To your feed  -->
<div class="modal fade bd-example-modal-lg" id="sort-title" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateprofilepicModalLabel">Sort Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul id="sortable" class="ui-sortable" style="list-style: none;
                    float: left;">
                    @if (!$project_media_title->isEmpty())
                    @foreach ($project_media_title as $val)
                    <li id="117">
                        <i class="fa fa-sort"></i>
                        <strong>{{ $val->title ?? '' }}</strong>
                    </li>
                    @endforeach
                    @endif
                </ul>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<!-- Modal End -->



<!-- Modal Start Add Media File -->
<div class="modal fade  bd-example-modal-lg" id="add_media" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateprofilepicModalLabel"> Add Media </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="d-flex">
                    <div class="col-md-4" id="add_title">
                        <div class="new_music add-title-event" data-toggle="modal" data-target="#add_image_pdf">
                            <div>
                                <i class="fa fa-plus circle-icon-b" aria-hidden="true"></i>
                                <p>Add Title</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" id="add_image">
                        <div class="new_music add-img-pdf-event" data-toggle="modal" data-target="#add_vedio">
                            <div>
                                <i class="fa fa-plus circle-icon-b" aria-hidden="true"></i>
                                <p>Add Image/PDF</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" id="add_video">
                        <div class="new_music add-video-event" data-toggle="modal" data-target="#add_soundcloud_spotify">
                            <div>
                                <i class="fa fa-plus circle-icon-b" aria-hidden="true"></i>
                                <p>Add Video</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="py-2 add_title_div" id="add-title-input" style="display: none">
                    <form name="media_form" id="media_form_one" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-8 text-left">
                            <label class="mb-0">Title</label>
                            <input type="hidden" name="media_cat_type" value="1">
                            <input type="hidden" name="project_id" value="{{ request()->route('id') }}">
                            <input type="text" name="title" id="title" class="form-control" placeholder="Please enter the Description Title" required>
                            <span class="text-danger" id="title_error"></span>
                        </div>
                        <div class="col-md-12 py-1 text-right">
                            <button type="submit" class="btn btn-theme media_btn_save" data-id="1">Save</button>
                        </div>
                    </form>
                </div>


                <div class="py-2 text-left add_image_div" id="add-img-pdf" style="display: none">
                    <form name="media_form" id="media_form_two" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12 py-1">
                            <label class="mb-0">Under Title <span class="mandatory">*</span></label>
                            <input type="hidden" name="media_cat_type" value="2">
                            <input type="hidden" name="project_id" value="{{ request()->route('id') }}">
                            <select class="form-control" name="title_id" required>
                                <option>Select Title</option>
                                @if (!$project_media_title->isEmpty())
                                @foreach ($project_media_title as $val)
                                <option value="{{ $val->id }}">{{ $val->title }}</option>
                                @endforeach
                                @endif
                            </select>
                            <span class="text-danger" id="title_id_error"></span>
                        </div>
                        <div class="col-md-12 py-1">
                            <label class="mb-0">Select Image/ PDF</label>
                            <input type="file" name="media" class="form-control" required>
                            <span class="text-danger" id="media_error"></span>
                        </div>
                        <div class="col-md-12 py-1">
                            <label class="mb-0">Description</label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                        <div class="col-md-12 py-1 text-right">
                            <button type="submit" class="btn btn-theme media_btn_save" data-id="2">Save</button>
                        </div>
                    </form>
                </div>

                <div class="py-2 add_video_div" id="add-video" style="display: none">
                    <form name="media_form" id="media_form_three" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12 py-1 text-left">
                            <div class="col-md-12 py-1">
                                <input type="hidden" name="media_cat_type" value="3">
                                <input type="hidden" name="project_id" value="{{ request()->route('id') }}">
                                <label class="mb-0">Under Title <span class="mandatory">*</span></label>
                                <select class="form-control" name="title_id" required>
                                    <option>Select Title</option>
                                    @if (!$project_media_title->isEmpty())
                                    @foreach ($project_media_title as $val)
                                    <option value="{{ $val->id }}">{{ $val->title }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <span class="text-danger" id="title_id_error"></span>
                            </div>
                            <div class="col-md-12 py-3">
                                <div class="form-check">
                                    <input class="form-check-input coupon_question" name="youtube" type="checkbox" value="1" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        YouTube Video
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 py-3 upload_video" style="display: none">
                                <label class="mb-0">Upload Video</label>
                                <input type="file" name="youtube_media">
                                <span class="text-danger" id="youtube_media_error"></span>
                            </div>
                            <div class="col-md-12 py-3 youtube_link">
                                <label class="mb-0">Youtube Link</label>
                                <input type="text" name="youtube_link" class="form-control">
                                <span class="text-danger" id="youtube_link_error"></span>
                            </div>
                            <div class="col-md-12 py-1">
                                <label class="mb-0">Description</label>
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                            <div class="col-md-12 py-1 text-right">
                                <button type="submit" class="btn btn-theme media_btn_save" data-id="3">Save</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal End -->

<!-- Modal  Start To your Edit Title  -->
<div class="modal fade bd-example-modal-lg" id="edit-title-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header add-b-border">
                <h5 class="modal-title">Edit Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left">
                <div class="row">
                    <div class="col-md-7 flex-aling-v">
                        <label class="mb-0 pr-1">Title</label>
                        <input type="text" name="title" id="title" class="form-control">
                        <i class="fa fa-trash-o pl-20" aria-hidden="true" onclick="deleteTitle()"></i>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary bg-color" onclick="updateTitle()">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->

<!-- Modal  Start To your feed  -->
<div class="modal fade" id="added-from-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header add-b-border">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left">
                <div class="row">
                    <div class="col-md-12">
                        <label class="mb-0 pr-1">Added From<span class="mandatory">*</span></label>
                        @if(count($profile_arr) >0 )
                        <select class="form-control" name="users_profiles_id" id="users_profiles_id">
                            <option>Select a profile</option>
                            @foreach ($profile_arr as $key => $val)
                            <option value="{{ $key }}" {{ (in_array($key, explode(',',Auth::guard('user')->user()->profile_id)))?'selected':'' }}>{{ $val }} </option>
                            @endforeach
                        </select>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary bg-color" onclick="getUpdate()">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->
<!-- Modal  Start Add Role in Sidebar -->
<div class="modal fade bd-example-modal-lg" id="add-role-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form name="media_form_role" id="media_form_role" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="project_id" value="{{ request()->route('id') }}">
            <div class="modal-content">
                <div class="modal-header add-b-border">
                    <h5 class="modal-title">Add Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-left">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-check custom-check">
                                <input class="form-check-input" type="checkbox" name="is_wanted" id="wanted-check-field" value="1">
                                <label class="form-check-label pl-1" for="wanted-check-field">
                                    &nbsp;
                                    &nbsp;Wanted
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12" id="img-upload">
                            <div class="row d-flex">
                                <div class="col-md-6">
                                    <label class="custom-label d-block">Picture</label>
                                    <button onclick="HandleBrowseClick('input-image-hidden');" class="btn btn-primary custom-btn">UPLOAD IMAGE</button>
                                    <input style="display:none" name="image" id="input-image-hidden" onchange="document.getElementById('image-preview').src = window.URL.createObjectURL(this.files[0])" type="file" accept="image/jpeg, image/png">
                                </div>
                                <div class="col-md-6">
                                    <div class="image-preview-box">
                                        <img id="image-preview" src="">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12" id="tag-key-people-block1">
                            <label class="custom-label">Tag Key people <span class="mandatory">*</span></label>
                            @if (!$keypeoples->isEmpty())
                            <select name="keypeople" class="selectpicker mb-15 form-control select2">
                                <option value="">--Select Keypeople--</option>
                                @foreach ($keypeoples as $val)
                                <option value="{{ $val->id }}">{{ $val->title }}</option>
                                @endforeach
                            </select>
                            @endif
                            <span class="text-danger" id="keypeople_error"></span>
                        </div>
                        <div class="col-md-12">
                            <label class="custom-label">Category <span class="mandatory">*</span></label>

                            @if (!$project_role_categories->isEmpty())
                            <select name="project_role_category" class="form-control">
                                <option value="">--Select Category--</option>
                                @foreach ($project_role_categories as $val)
                                <option value="{{ $val->id }}">{{ $val->title }}</option>
                                @endforeach
                            </select>

                            @endif
                            <span class="text-danger" id="project_role_category_error"></span>
                        </div>
                        <div class="col-md-12">
                            <label class="custom-label">Role Title <span class="mandatory">*</span></label>
                            <input type="text" name="role_title" class="form-control" placeholder="Role Title">
                            <span class="text-danger" id="role_title_error"></span>
                        </div>
                        <div class="col-md-12 pt-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="d-flex">Compensation <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check radio-btn-v-center">
                                        <input class="form-check-input" type="radio" name="compensation" id="collaboration" onchange="showPriceTag(1)" value="1" checked>
                                        <label class="form-check-label" for="collaboration">
                                            Collaboration
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check radio-btn-v-center">
                                        <input class="form-check-input" type="radio" name="compensation" id="expenses_only" onchange="showPriceTag(2)" value="2">
                                        <label class="form-check-label" for="expenses_only">
                                            Expenses Only
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check radio-btn-v-center">
                                        <input class="form-check-input" type="radio" name="compensation" id="paid" onchange="showPriceTag(3)" value="3">
                                        <label class="form-check-label" for="paid">
                                            Paid
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" id="collaboration-div">
                        </div>
                        <div class="col-md-12" id="expenses_only-div">
                        </div>
                        <div class="col-md-12 pt-4 paid-div" style="display: none;">
                            <div class="row">
                                <div class="col-md-1">
                                    Price
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="price" class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary bg-color">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal End -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/js/swiper.min.js"></script> --}}
{{-- <script type="text/javascript" src="assets/js/swiper-slider.js"></script> --}}
{{-- <script type="text/javascript" src="assets/js/custom.js"></script> --}}

<div class="modal fade bd-example-modal-lg" id="edit-role-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form name="media_form_role_edit" id="media_form_role_edit" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="project_id" value="{{ request()->route('id') }}">
            <div class="modal-content">
                <div class="modal-header add-b-border">
                    <h5 class="modal-title">Edit Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-left">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-check custom-check">
                                <input class="form-check-input" type="checkbox" name="is_wanted" id="wanted-check-field-edit" value="1">
                                <label class="form-check-label pl-1" for="wanted-check-field-edit">
                                    &nbsp;
                                    &nbsp;Wanted
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12" id="img-upload-edit">
                            <div class="row d-flex">
                                <div class="col-md-6">
                                    <label class="custom-label d-block">Picture</label>
                                    <button onclick="HandleBrowseClick('input-image-hidden');" class="btn btn-primary custom-btn">UPLOAD IMAGE</button>
                                    <input style="display:none" name="image" id="input-image-hidden-edit" onchange="document.getElementById('image-preview').src = window.URL.createObjectURL(this.files[0])" type="file" accept="image/jpeg, image/png">
                                </div>
                                <div class="col-md-6">
                                    <div class="image-preview-box">
                                        <img id="image-preview" src="">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12" id="tag-key-people-block1">
                            <label class="custom-label">Tag Key people <span class="mandatory">*</span></label>
                            @if (!$keypeoples->isEmpty())
                            <select name="keypeople" class="selectpicker mb-15 form-control select21">
                                <option value="">--Select Keypeople--</option>
                                @foreach ($keypeoples as $val)
                                <option value="{{ $val->id }}">{{ $val->title }}</option>
                                @endforeach
                            </select>
                            @endif
                            <span class="text-danger" id="keypeople_error"></span>
                        </div>
                        <div class="col-md-12">
                            <label class="custom-label">Category <span class="mandatory">*</span></label>

                            @if (!$project_role_categories->isEmpty())
                            <select name="project_role_category" class="form-control">
                                <option value="">--Select Category--</option>
                                @foreach ($project_role_categories as $val)
                                <option value="{{ $val->id }}">{{ $val->title }}</option>
                                @endforeach
                            </select>

                            @endif
                            <span class="text-danger" id="project_role_category_error"></span>
                        </div>
                        <div class="col-md-12">
                            <label class="custom-label">Role Title <span class="mandatory">*</span></label>
                            <input type="text" name="role_title" class="form-control" placeholder="Role Title">
                            <span class="text-danger" id="role_title_error"></span>
                        </div>
                        <div class="col-md-12 pt-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="d-flex">Compensation <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check radio-btn-v-center">
                                        <input class="form-check-input" type="radio" name="compensation" id="collaboration" onchange="showPriceTag(1)" value="1" checked>
                                        <label class="form-check-label" for="collaboration">
                                            Collaboration
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check radio-btn-v-center">
                                        <input class="form-check-input" type="radio" name="compensation" id="expenses_only" onchange="showPriceTag(2)" value="2">
                                        <label class="form-check-label" for="expenses_only">
                                            Expenses Only
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check radio-btn-v-center">
                                        <input class="form-check-input" type="radio" name="compensation" id="paid" onchange="showPriceTag(3)" value="3">
                                        <label class="form-check-label" for="paid">
                                            Paid
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" id="collaboration-div">
                        </div>
                        <div class="col-md-12" id="expenses_only-div">
                        </div>
                        <div class="col-md-12 pt-4 paid-div" style="display: none;">
                            <div class="row">
                                <div class="col-md-1">
                                    Price
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="price" class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary bg-color">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@push('custom-script')
<script type="text/javascript">
    $(document).ready(function() {
        $('.coupon_question').click(function() {
            if ($('.coupon_question').is(":checked")) {
                $(".upload_video").show();
                $(".youtube_link").hide();
            } else {
                $(".upload_video").hide();
                $(".youtube_link").show();
            }
        })
    });

    function showPriceTag(id) {
        if (id == 3) {
            $('.paid-div').show('slow');
        } else {
            $('.paid-div').hide('slow');
        }
    }
</script>
<script type="text/javascript">
    function HandleBrowseClick(input_image) {
        var fileinput = document.getElementById(input_image);
        fileinput.click();
    }
</script>
<script type="text/javascript">
    $('#wanted-check-field').change(function() {
        if ($('#wanted-check-field').prop('checked')) {
            $('#img-upload').show('slow');
        } else {
            $('#img-upload').hide('slow');
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#media_form_one').on('submit', function(e) {
            e.preventDefault();
            var datastring = new FormData($('#media_form_one')[0]);

            getAjaxFormData(datastring);
        });

        $('#media_form_two').on('submit', function(e) {
            e.preventDefault();
            var datastring = new FormData($('#media_form_two')[0]);

            getAjaxFormData(datastring);
        });

        $('#media_form_three').on('submit', function(e) {
            e.preventDefault();
            var datastring = new FormData($('#media_form_three')[0]);

            getAjaxFormData(datastring);
        });
    });

    function getAjaxFormData(datastring) {
        $.ajax({
            url: "{{ route('project.add.media') }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: datastring,
            cache: false,
            contentType: false,
            processData: false,
            success: function(res) {
                alert("Successfully Added");
                location.reload();
            },
            error: function(xhr, error) {
                $.each(xhr.responseJSON.errors, function(field_name, error) {
                    $(document).find('[id=' + field_name + '_error' + ']').text(error)
                })
            }
        });
    }

    $('#add_title').click(function() {
        $('.add_title_div').show();
        $('.add_image_div').hide();
        $('.add_video_div').hide();
    });
    $('#add_image').click(function() {
        $('.add_image_div').show();
        $('.add_title_div').hide();
        $('.add_video_div').hide();
    });
    $('#add_video').click(function() {
        $('.add_video_div').show();
        $('.add_title_div').hide();
        $('.add_image_div').hide();

    });


    // Edit Title



    $("#edit-title").click(function() {
        var edit_title_id = $(this).data('id');
        var edit_title = $(this).data('title');

        $('#edit-title-modal').find('input').val(edit_title);
        $('#edit-title-modal').attr('data-hid-title-id', edit_title_id);
        $('#edit-title-modal').modal('show');
    })

    function updateTitle() {
        var edit_title_id = $('#edit-title-modal').data('hid-title-id');
        var edit_title = $('#edit-title-modal').find('input').val();

        var url = "{{ route('project.update.media') }}";
        getUpdateAjax(edit_title_id, url, edit_title);
    }

    function deleteTitle() {
        var edit_title_id = $('#edit-title-modal').data('hid-title-id');
        var url = "{{ route('project.delete.media') }}";
        getDeleteAjax(edit_title_id, url);
    }


    function getUpdateAjax(data_id, url, title) {

        $.ajax({
            url: url,
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'id': data_id,
                'title': title
            },
            cache: false,
            success: function(res) {
                swal(res.msg);
                setTimeout(() => {
                    location.reload();
                }, 3000);

            },
            error: function(xhr, error) {
                console.log(error);
            }
        });
    }

    function getDeleteAjax(data_id, url) {

        $.ajax({
            url: url,
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'id': data_id
            },
            cache: false,
            success: function(res) {
                swal(res.msg);
                setTimeout(() => {
                    location.reload();
                }, 3000);

            },
            error: function(xhr, error) {
                console.log(error);
            }
        });
    }


    $('#media_form_role').on('submit', function(e) {
        e.preventDefault();
        var datastring = new FormData($('#media_form_role')[0]);

        var url = "{{ route('project.add.role.media') }}";
        getCommonAjaxForm(url, datastring);
    });

    function getCommonAjaxForm(url, datastring) {
        $.ajax({
            url: url,
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: datastring,
            cache: false,
            contentType: false,
            processData: false,
            success: function(res) {
                swal(res.msg);
                setTimeout(() => {
                    location.reload();
                }, 3000);

            },
            error: function(xhr, error) {
                $.each(xhr.responseJSON.errors, function(field_name, error) {
                    $(document).find('[id=' + field_name + '_error' + ']').text(error)
                })
            }
        });
    }


    function getUpdate() {
        var profile_id = $('#users_profiles_id').find('option:selected').val();
        $.ajax({
            url: "{{ route('project.update.added.form') }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'profile_id': profile_id
            },
            success: function(res) {
                swal(res.msg);
                setTimeout(() => {
                    //location.reload();
                }, 3000);

            },
            error: function(xhr, error) {
                console.log(error);
            }
        });
    }

    $('#wanted-check-field-edit').change(function() {
        if ($('#wanted-check-field-edit').prop('checked')) {
            $('#img-upload-edit').show('slow');
        } else {
            $('#img-upload-edit').hide('slow');
        }
    });

    function showDesignerInvesterModel(id) {
        var datastring = "edit_role_id=" + id;

        var url = "{{ route('project.edit.role.form') }}";
        $.ajax({
            url: url,
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: datastring,
            success: function(res) {
                var $is_wanted = (res.is_wanted == 1) ? true : false;

                var $compensation = (res.compensation == 1) ? true : (res.compensation == 2) ? true : (res.compensation == 3) ? true : false;

                $('#edit-role-modal').find('input[name="is_wanted"]').prop('checked', $is_wanted);
                //$('#edit-role-modal').find('#wanted-check-field-edit').trigger("click")

                ($is_wanted == 1) ? $('#edit-role-modal').find('#img-upload-edit').css('display', 'block'):
                    $('#edit-role-modal').find('#img-upload-edit').css('display', 'none');

                $('#edit-role-modal').find('img').attr("src", "/uploads/" + res.image);

                $('#edit-role-modal').find('input[name=role_title]').val(res.role_title);

                $('#edit-role-modal').find('select[name=keypeople]').val(res.keypeople);
                $('#edit-role-modal').find('select[name=project_role_category]').val(res.project_role_category);

                $('#edit-role-modal').find('input[name=compensation]').prop('checked', $compensation);

                showPriceTag(res.compensation)
                $('#edit-role-modal').find('name[name=price]').val(res.price);

            },
            error: function(xhr, error) {
                console.log(error);
            }
        });


        $('#edit-role-modal').modal('show');
    }
</script>


@endpush