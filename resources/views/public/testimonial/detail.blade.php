@extends('public.layouts.layout')

@section('content')

    <section class="testimonials-section">
        <div class="container">
            <div class="testimonials-list">
                @foreach ($detail as $key => $value)
                    
                    <div class="testimonials-card">
                        <div class="row panel-space">
                            <div class="col-md-3">
                                <img src="{{ asset('/') }}uploads/testimonails/{{ $value->media }}" class="testimonials-img">
                            </div>
                            <div class="col-md-9 testimonial-info-area">
                                <h2>{{ $value->full_name }}</h2>
                                <p class="designation-testi">{{ $value->profession }}</p>
                                <div class="teaser">
                                    <p>
                                        <?php echo substr(strip_tags($value->testimonial),0,200) ?><span class="complete" id="complete-{{$key}}"><?php echo substr(strip_tags($value->testimonial),200, -1) ?></span>
                                    </p>
                                </div>
                                
                                <button class="read-more-less-btn" data-id="{{$key}}" id="read-more-{{$key}}">Read more</button>
                            </div>

                        </div>
                    </div>

                @endforeach

            </div>
        </div>
    </section>

    @push('custom-script')
        <script>
            $('.read-more-less-btn').click(function(e) {
                $('#complete-' + $(this).attr('data-id')).slideToggle( "fast" );
                    
                    var $this = $(this);
                    $this.toggleClass("open");

                    if ($this.hasClass("open")) {
                        $this.html("Less");
                    } else {
                        $this.html("Read more");
                    }
            });
            
        </script>
        
    @endpush


@endsection
