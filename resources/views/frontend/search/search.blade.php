@extends('frontend.layouts.layout')

@section('content')

    <section id="posted-project-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-right add-project-area">
                  <!--  <span class="add-project-txt-title">Add Project</span>
                   <div><i class="fa fa-plus plus-icon" aria-hidden="true"></i></div> -->
                </div>
            </div>
            <div class="row pt-3">
                @foreach($search_result as $search)
                    <div class="col-md-3">
                        <div class="card project-card">
                            <div class="card-img card-people">
                                <img class="card-img-peopel" src="assets/images/portrait.png">
                            </div>
                            <div class="card-body">
                                <p class="card-text-txt">{{ $search->full_name }}</p>
                                <div class="card-item">
                                    <p class="location-details">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <span class="span-1">{{ $search->city->title }}, {{ $search->country->title }}</span></p>
                                    <p></p>
                                </div>
                                <div class="card-item">
                                    <p>
                                        <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                        <span class="span-2" data-toggle="modal" data-target="#review-modal">Reviews </span>
                                        <i class="fa fa-star bg-color" aria-hidden="true"></i>
                                    </p>
                                    <p>0</p>
                                </div>
                                <div class="card-item">
                                    <p>
                                        <i class="fa fa-folder-open-o" aria-hidden="true"></i>
                                        <span class="span-3">Contributions</span>
                                    </p>
                                    <p>0</p>
                                </div>
                                <div class="card-item">
                                    <p>
                                        <i class="fa fa-diamond" aria-hidden="true"></i>
                                        <span class="span-4">MKP Score</span>
                                    </p>
                                    <p>0</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection