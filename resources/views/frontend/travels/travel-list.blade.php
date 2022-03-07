@extends('frontend.layouts.layout')

@section('content')
    <section id="posted-project-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-right add-project-area">
                    <span class="add-project-txt-title">Add Travel</span>
                    <div><a href="{{ route('travel.add') }}"><i class="fa fa-plus plus-icon" aria-hidden="true"></i></a></div>
                </div>
            </div>
            <div class="row pt-3">
                @if(count($travels) > 0)
                @foreach ($travels as $travel) 
                <div class="col-md-3"> 
                    <a href="{{ route('travel.details', $travel->id) }}">
                        <div class="card project-card"> 
                            <div class="card-img">
                                <img class="card-img-top"
                                    src="{{ asset('uploads/'.$travel->image ) }}">
                            </div>
                            <div class="card-body">
                                <p class="card-text-txt">Hello</p>
                                <p class="card-text">{{ $travel->title }}</p>
                            </div>
                            <div class="card-footer text-muted card-footer-bg">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span>{{  \General::getSingleRow('city','title', $travel->city_id) }}, {{  \General::getSingleRow('countries','title',$travel->country_id) }}</span>
                            </div>
                           
                        </div> 
                    </a>
                </div> 
                @endforeach
                @endif
            </div>
        </div>
    </section>

@endsection
