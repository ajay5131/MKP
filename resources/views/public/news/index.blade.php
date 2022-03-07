@extends('public.layouts.layout')

@section('content')

    <section class="team-list-s-f-2">
        <div class="container">
            <div class="row panel-space">
                @if(count($news) > 0)
                    @foreach ($news as $key => $value)

                        <div class="card">
                            <div class="row no-gutters">
                                <div class="col-sm-7">
                                    <div class="card-body">
                                        <h5><?php echo $value->title ?></h5>
                                        <p class="panel-paragrap-text"> <?php echo substr($value->description, 0, 110) ?></p>
                                        <a class="btn btn-primary btnTheme" href="{{ route('news.detail', $value->slug) }}">Read More</a>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <img src="{{ asset('/')}}uploads/news/{{ $value->media }}" class="panel-img card-img">
                                </div>
                            </div>
                        </div>
                        
                    @endforeach
                @else 
                    <p>No records found!</p>
                @endif
            </div>
        </div>
    </section>

@endsection