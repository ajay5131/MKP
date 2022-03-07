@extends('public.layouts.layout')

@section('content')

    <section class="team-list-s-f-2">
        <div class="container">
            <div class="row panel-space">
                <div class="card-profile">
                    <div class="row no-gutters">
                        <div class="col-sm-4">
                            <img src="{{ asset('/')}}uploads/news/{{ $news->media }}"
                                class="details-panel-img card-img">
                        </div>
                        <div class="col-sm-8">
                            <div class="card-body">
                                <h3><?php echo $news->title ?></h3>
                                <div class="profile-panel-paragrap-text">
                                    <?php echo $news->description ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection