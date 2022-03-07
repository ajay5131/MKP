@extends('public.layouts.layout')

@section('content')

  
    <section class="team-list-s-f-2">
        <div class="container">
            <div class="row panel-space">
                <div class="card-profile">
                    <div class="row no-gutters">
                        <div class="col-sm-4">
                            <img src="{{ asset('/')}}uploads/our_team/{{ $team->media }}"
                                class="details-panel-img card-img">
                        </div>
                        <div class="col-sm-8">
                            <div class="card-body">
                                <h3><?php echo $team->full_name ?></h3>
                                <h6><?php echo $team->designation ?></h6>
                                <div class="profile-panel-paragrap-text">
                                    <?php echo $team->description ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection