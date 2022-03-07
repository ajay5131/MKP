@if(isset($slider) && count($slider) > 0)
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach ($slider as $key => $value)
                <div class="swiper-slide">
                    <div class="slide-inner">
                            @if($value->media_type == 'mp4')
                                <video class="img-fluid w-100" id="bgvid_{{$key}}" preload="metadata">
                                    <source src="{{ asset('/') }}uploads/slider/{{$value->media}}" type="video/mp4" />
                                </video>
                            @else
                                <img src="{{ asset('/') }}uploads/slider/{{$value->media}}" class="w-100">
                            @endif

                            <div class="slider-txt">
                                <h1>{{ (!empty($value->title) ? $value->title : '') }}</h1>
                                <p>{{ (!empty($value->description) ? $value->description : '') }}</p>
                                @if($value->media_type == 'mp4')
                                    <button id="btn_{{$key}}" onclick="play_pause({{$key}})">@lang('messages.play')</button>
                                @endif
                                @if(!empty($value->show_more_btn_link))
                                    <a href="<?php echo $value->show_more_btn_link ?>" target="_blank">@lang('messages.show_more')</a>
                                @endif
                            </div>
                    </div>
                </div>

            @endforeach
            
        </div>
        <div class="swiper-button-next swiper-button-white"></div>
        <div class="swiper-button-prev swiper-button-white"></div>
    </div>

    @push('custom-script')
        <script>
            function play_pause(key) {

                var video = document.getElementById("bgvid_"+key);
                var btn = document.getElementById("btn_"+key);
                if (video.paused) {
                    video.play();
                    btn.innerHTML = "Pause";
                } else {
                    video.pause();
                    btn.innerHTML = "@lang('messages.play')";
                }
            }

        </script>
    @endpush
@endif
