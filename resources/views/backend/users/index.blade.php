@extends('backend.layouts.app_layout')

@section('content')

    @push('custom-style')
        <style>
            .custom_dropdown {
                left:-100px !important;
            }
            .custom_dropdown:before {
                left:129px !important;
            }
            .custom_dropdown:after {
                left:130px !important;
            }
        </style>
    @endpush
    <!-- Laravel package configured in config/app.php -->
    @include('flash::message')

    <div class="row">
        <div class="col-md-12"> 
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption"> <i class="icon-info font-dark"></i> <span class="caption-subject font-dark sbold uppercase">List</span> </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <form method="post" role="form" id="search-form">
                            <div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover"  id="table__id">
                                    <thead>
                                        <tr role="row" class="filter">
                                            <td></td>
                                            <td><input type="text" class="form-control" name="title" id="title" autocomplete="off" placeholder="Title"></td>                      
                                            <td><input type="text" class="form-control" name="email" id="email" autocomplete="off" placeholder="Email"></td>                      
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr role="row" class="heading">                                            
                                            <th>Profile Picture</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Profile Selected</th>
                                            <th>How Did hear about us?</th>
                                            <th>Profiles</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
        $(function () {
            var oTable = $('#table__id').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: false,
                ajax: {
                    url: '{!! route('admin.list.user.profiles') !!}',
                    data: function (d) {
                        d.title = $('input[name=title]').val();
                        d.email = $('input[name=email]').val();
                    }
                }, columns: [
                    {data: 'profile_pic', name: 'profile_pic', orderable: false, searchable: false},
                    {data: 'full_name', name: 'full_name'},
                    {data: 'email', name: 'email'},
                    {data: 'who_are_you', name: 'who_are_you'},
                    {data: 'how_did_hear_about_us', name: 'how_did_hear_about_us', orderable: false, searchable: false},
                    {data: 'profiles', name: 'profiles', orderable: false, searchable: false},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
            $('#search-form').on('submit', function (e) {
                
                oTable.draw();
                e.preventDefault();
            });
            
            $('#title').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#email').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
            });
        });

        function changeStatus(user_id, status) {
            
            $.post("{{ route('admin.change.users.status') }}", {user_id: user_id, status:status, _method: 'POST', _token: '{{ csrf_token() }}'})
            .done(function (response) {
                var table = $('#table__id').DataTable();
                table.row('adminDtRow' +user_id).remove().draw(false);
            });
        
        }
    </script>

@endpush