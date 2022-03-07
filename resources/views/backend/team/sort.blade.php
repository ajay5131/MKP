@extends('backend.layouts.app_layout')

@section('content')
    <!-- Laravel package configured in config/app.php -->
    @include('flash::message')

    <div class="row our_team">
        <div class="col-md-12"> 
            <ul class="tabs">
                <li class='active' data-teamtype='1'>MKP Team</li>
                <li class='' data-teamtype='2'>Partners</li>
                <li class='' data-teamtype='3'>Mentor</li>
            </ul>
            <ul class="tab__content">
                <li class="active" id="team_sort_1"></li>
                <li id="team_sort_2"></li>
                <li id="team_sort_3"></li>
            </ul>
        </div>
    </div>

@endsection

@push('custom-script')

    <script>
        $(document).ready(function() {
            // Default 
            getData(1);

            var clickedTab = $(".tabs > .active");
            var tabWrapper = $(".tab__content");
            var activeTab = tabWrapper.find(".active");
            var activeTabHeight = activeTab.outerHeight();
            
            activeTab.show();
            tabWrapper.height(activeTabHeight + 50);
            
            $(".tabs > li").on("click", function() {
                $(".tabs > li").removeClass("active");
                $(this).addClass("active");
                $team_type = $(this).data('teamtype');

                getData($team_type);

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

            function getData(team_type) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.team.sort.data') }}",
                    data: {teamtype: team_type },
                    success: function (responseData) {
                        $("#team_sort_" + team_type).html('');
                        $("#team_sort_" + team_type).html(responseData);

                        $('.sortable').sortable({
                            update: function (event, ui) {
                                var team_order = $(this).sortable('toArray').toString();
                                $.post("{{ route('admin.team.sort.update') }}", {team_order: team_order, _method: 'post', _token: '{{ csrf_token() }}'})
                            }
                        });
                        $(".sortable").disableSelection();
                        
                        setTimeout(() => {
                            $('.tab__content').css('height', $("#team_sort_" + team_type).height() + 20);
                        }, 200);

                    }
                });
            }
            
        });        
    </script>

@endpush