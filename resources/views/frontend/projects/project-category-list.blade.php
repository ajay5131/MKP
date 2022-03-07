@extends('frontend.layouts.layout')

@section('content')
<section id="project-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="project-category">
          <a href="{{ route('project.list') }}">
            <div class="project-cate-img-1 zoom"></div>
            <div class="project-info-area">
              <img src="{{ asset('assets/images/project-management.png') }}" class="proj-img-icon">
              <span class="project-txt"> Projects </span>
              <span class="project-no"> {{ $total_projects ?? 0 }}</span>
            </div>
          </a>
        </div>


        <div class="project-category">
        <a href="{{ route('travel.list') }}">
          <div class="project-cate-img-2 zoom"></div>
          <div class="project-info-area">
            <img src="{{ asset('assets/images/worldwide.png') }}" class="proj-img-icon">
            <span class="project-txt"> Travels </span>
            <span class="project-no"> {{ $total_travels ?? 0 }}</span>
          </div>
        </a>
        </div>



        <div class="project-category" id="proj-cate-one">
          <div class="project-cate-img-3 zoom"></div>
          <div class="project-info-area">
            <img src="{{ asset('assets/images/team.png') }}" class="proj-img-icon">
            <span class="project-txt"> Jobs </span>
            <span class="project-no"> {{ $total_jobs ?? 0 }}</span>
          </div>
        </div>

        <div class="project-category" id="proj-cate-one">
          <div class="project-cate-img-4 zoom"></div>

          <div class="project-info-area">
            <img src="{{ asset('assets/images/listing.png') }}" class="proj-img-icon">
            <span class="project-txt">Listings</span>
            <span class="project-no"> {{ $total_listings ?? 0 }}</span>
          </div>
        </div>

        <div class="project-category" id="proj-cate-one">
          <div class="project-cate-img-5 zoom"></div>
          <div class="project-info-area">
            <img src="{{ asset('assets/images/event.png') }}" class="proj-img-icon">
            <span class="project-txt">Events</span>
            <span class="project-no"> {{ $total_events ?? 0 }}</span>
          </div>
        </div>

      </div>
    </div>
  </div>

</section>

@endsection