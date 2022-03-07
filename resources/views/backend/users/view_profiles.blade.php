@extends('backend.layouts.app_layout')

@section('content')

    @push('custom-style')
        <style>
            .dropdown {
                position: relative;
                display: inline-block;
                cursor: pointer;
            }
            .dropdown:hover .dropdown-content {
                display: block
            }

            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #f9f9f9;
                min-width: 190px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
                padding: 0px;
            }

            .dropdown-content a {
                color: black;
                padding: 8px 8px;
                text-decoration: none;
                display: block;
            }

            .dropdown-content a:hover {background-color: #f1f1f1}
            .selected_lbl{
                background-color: lightgray;
            }
        </style>
    @endpush
    <!-- Laravel package configured in config/app.php -->
    @include('flash::message')

    <div class="row">
        <div class="col-md-12"> 
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption"> <i class="icon-info font-dark"></i> <span class="caption-subject font-dark sbold uppercase">Profiles</span> </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <form method="post" role="form" id="search-form">
                            <div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover"  id="table__id">
                                    <thead>
                                        <tr role="row" class="filter">
                                            <th>#</th>
                                            <th>Profile</th>
                                            <th>Picture</th>
                                            <th>Full Name</th>      
                                            <th>Badge</th>                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php  foreach ($user_profiles   as $key => $value) { ?>
                                            <tr>
                                                <td><?php echo ($key + 1) ?></td>
                                                <td><?php echo  $profiles[$value->profile_id] ?></td>
                                                <td><img src="{{ asset('/')}}uploads/profile_picture/{{$value->profile_pic}}" height="80"/></td>
                                                <td><?php echo $value->full_name ?></td>
                                                <td>
                                                    <?php $profiles_badge = ['None', 'Represented by MKP', 'VIP', 'Recommended by MKP'] ?>
                                                    <?php $profiles_badge_color = ['black', '#3598dc', 'red', 'green'] ?>
                                                    
                                                    <div class="dropdown profile_badge">
                                                        <span id="active_profile_badge_{{$value->id}}"> <i class='fa fa-circle' style='color:{{$profiles_badge_color[$value->profile_badge]}};' aria-hidden='true'></i> <?php echo $profiles_badge[$value->profile_badge]; ?></span>
                                                        <div class="dropdown-content" data-id="{{$value->id}}">
                                                            <a data-id='3' {{ $value->profile_badge == 3 ? 'selected_lbl' : '' }} class=''><i class='fa fa-circle' style='color:green;' aria-hidden='true'></i><span> Recommended by MKP</span></a>        
                                                            <a data-id='1' {{ $value->profile_badge == 1 ? 'selected_lbl' : '' }} class=''><i class='fa fa-circle' style='color:#3598dc;' aria-hidden='true'></i><span> Represented by MKP</span></a>        
                                                            <a data-id='2' {{ $value->profile_badge == 2 ? 'selected_lbl' : '' }} class=''><i class='fa fa-circle' style='color:red;' aria-hidden='true'></i><span> VIP</span></a>        
                                                            <a data-id='0' {{ $value->profile_badge == 0 ? 'selected_lbl' : '' }} class=''><i class='fa fa-circle' aria-hidden='true'></i><span> None</span></a>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                            </tr>
                                        <?php  } ?>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('custom-script')

    <script>

        $(document).on('click', '.profile_badge a', function () {
            if (!$(this).hasClass('selected_lbl')) {
                var that = $(this);
                var id = $(this).parent().attr('data-id');
                
                $.post("{{ route('update.profile.badge') }}", {id: id, profile_badge: $(this).attr('data-id'), _method: 'POST', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    that.parent().find('a.selected_lbl').removeClass('selected_lbl');
                    that.addClass('selected_lbl');
                    $('#active_profile_badge_' + id).html(that.html());
                });
            }
        })
        
    </script>

@endpush