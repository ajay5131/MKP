@extends('frontend.layouts.layout')

@section('content')
    <section id="posted-project-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-right add-project-area">
                    <span class="add-project-txt-title">Add Project</span>
                    <div><a href="{{ route('project.add') }}"><i class="fa fa-plus plus-icon" aria-hidden="true"></i></a></div>
                </div>
            </div>
            <div class="row pt-3">
                @if(count($projects) > 0)
                @foreach ($projects as $project) 
                <div class="col-md-3"> 
                    <a href="{{ route('project.details', $project->id) }}">
                        <div class="card project-card"> 
                            <div class="card-img">
                                <img class="card-img-top"
                                    src="{{ asset('uploads/'.$project->image ) }}">
                            </div>
                            <div class="card-body">
                                <p class="card-text-txt">{{ \General::getSingleRow('project_type','project_type',$project->project_type_id, 'project_type_id') }}</p>
                                <p class="card-text">{{ $project->title }}</p>
                            </div>
                            <div class="card-footer text-muted card-footer-bg">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span>{{  \General::getSingleRow('city','title', $project->city_id) }}, {{  \General::getSingleRow('countries','title',$project->country_id) }}</span>
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
