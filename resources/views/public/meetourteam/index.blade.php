@extends('public.layouts.layout')

@section('content')


<section class="team-list-s-f-2">
    <div class="container">
        @if(isset($team) && !empty($team))
            <div class="row">
                <div class="col-12 col-md-12 pl-0">
                    <h3 class="team-title-txt">MKP TEAM</h3>
                </div>
            </div>
            <div class="row panel-space">
                @foreach ($team as $key => $value)

                    <div class="card">
                        <div class="row no-gutters">
                            <div class="col-sm-5">
                                <img src="{{ asset('/')}}uploads/our_team/{{ $value->media }}" class="panel-img card-img">
                            </div>
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h5><?php echo $value->full_name ?></h5>
                                    <h6 class="designation"><?php echo $value->designation ?></h6>
                                    <p class="panel-paragrap-text"> <?php echo substr(strip_tags($value->description), 0, 100) ?></p>
                                    <a class="btn btn-primary btnTheme" href="{{ route('meet.our.team.detail', $value->slug)}}">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        @endif

        @if(isset($partner) && !empty($partner))
            <div class="row">
                <div class="col-12 col-md-12 pl-0">
                    <h3 class="team-title-txt pt-and-border">Partners</h3>
                </div>
            </div>

            <div class="row panel-space">
                @foreach ($partner as $key => $value)

                    <div class="card">
                        <div class="row no-gutters">
                            <div class="col-sm-5">
                                <img src="{{ asset('/')}}uploads/our_team/{{ $value->media }}" class="panel-img card-img">
                            </div>
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h5><?php echo $value->full_name ?></h5>
                                    <h6 class="designation"><?php echo $value->designation ?></h6>
                                    <p class="panel-paragrap-text"> <?php echo substr(strip_tags($value->description), 0, 100) ?></p>
                                    <a class="btn btn-primary btnTheme" href="{{ route('meet.our.team.detail', $value->slug)}}">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach

            </div>

        @endif

        @if(isset($mentor) && !empty($mentor))

            <div class="row">
                <div class="col-12 col-md-12 pl-0">
                    <h3 class="team-title-txt pt-and-border">MENTORS</h3>
                </div>
            </div>

            <div class="row panel-space">
                @foreach ($mentor as $key => $value)

                    <div class="card">
                        <div class="row no-gutters">
                            <div class="col-sm-5">
                                <img src="{{ asset('/')}}uploads/our_team/{{ $value->media }}" class="panel-img card-img">
                            </div>
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h5><?php echo $value->full_name ?></h5>
                                    <h6 class="designation"><?php echo $value->designation ?></h6>
                                    <p class="panel-paragrap-text"> <?php echo substr(strip_tags($value->description), 0, 100) ?></p>
                                    <a class="btn btn-primary btnTheme" href="{{ route('meet.our.team.detail', $value->slug)}}">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
                
            </div>
        @endif


  </section>

@endsection