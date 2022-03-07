@extends('backend.layouts.app_layout')

@section('content')
    <!-- Laravel package configured in config/app.php -->
    @include('flash::message')

    <div class="row our_team">
        <div class="col-md-12"> 
            <div id="sort_block"></div>
        </div>
    </div>

@endsection

@push('custom-script')

    <script>
        $(document).ready(function() {
            // Default 
            getData();

            var clickedTab = $(".tabs > .active");
            var tabWrapper = $(".tab__content");
            var activeTab = tabWrapper.find(".active");
            var activeTabHeight = activeTab.outerHeight();
            
            activeTab.show();
            tabWrapper.height(activeTabHeight + 50);
            
            $(".tabs > li").on("click", function() {
                $(".tabs > li").removeClass("active");
                $(this).addClass("active");

                getData();

                clickedTab = $(".tabs .active");
                activeTab.fadeOut(250, function() {
                    $(".tab__content > li").removeClass("active");
                    var clickedTabIndex = clickedTab.index();
                    $(".tab__content > li").eq(clickedTabIndex).addClass("active");
                    activeTab = $(".tab__content > .active");

                    activeTabHeight = activeTab.outerHeight();
                    
                    tabWrapper.stop().delay(50).animate({
                        height: (activeTab.outerHeight() + 20)
                    }, 100, function() {
                        activeTab.fadeIn(250);
                    });

                });

                setTimeout(() => {
                    $('.tab__content').css('height', activeTab.outerheight() + 20);
                }, 300);
            }); 

            function getData() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.faq.sort.data') }}",
                    data: { },
                    success: function (responseData) {
                        $("#sort_block").html('');
                        $("#sort_block").html(responseData);

                        $('.sortable').sortable({
                            update: function (event, ui) {
                                var sort_order = $(this).sortable('toArray').toString();
                                $.post("{{ route('admin.faq.sort.update') }}", {sort_order: sort_order, _method: 'PUT', _token: '{{ csrf_token() }}'})
                            }
                        });
                        $(".sortable").disableSelection();
                        
                        setTimeout(() => {
                            $('.tab__content').css('height', $("#sort_block").height() + 20);
                        }, 200);

                    }
                });
            }
            
        });        
    </script>

@endpush