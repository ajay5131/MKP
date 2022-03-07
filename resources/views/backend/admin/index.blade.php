@extends('backend.layouts.app_layout')

@section('content')
    <!-- Laravel package configured in config/app.php -->
    @include('flash::message')

    <div class="row">
        <div class="col-md-12"> 
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption"> <i class="icon-info font-dark"></i> <span class="caption-subject font-dark sbold uppercase">List</span> </div>
                    <div class="actions"> <a href="{{ route('admin.add.user') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Add User</a> </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <form method="post" role="form" id="admin-search-form">
                            <table class="table table-striped table-bordered table-hover"  id="adminuser__table">
                                <thead>
                                    <tr role="row" class="filter">
                                        <td><input type="text" class="form-control" name="title" id="title" autocomplete="off" placeholder="Title"></td>                      
                                        <td><input type="text" class="form-control" name="email" id="email" autocomplete="off" placeholder="Email"></td>                      
                                        <td></td>
                                    </tr>
                                    <tr role="row" class="heading">                                            
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
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
            var oTable = $('#adminuser__table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: false,
                ajax: {
                    url: '{!! route('admin.list.user') !!}',
                    data: function (d) {
                        d.title = $('input[name=title]').val();
                        d.email = $('input[name=email]').val();
                    }
                }, columns: [
                    {data: 'full_name', name: 'full_name'},
                    {data: 'email', name: 'email'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
            $('#admin-search-form').on('submit', function (e) {
                
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

        function deleteRecord(id) {
            if (confirm('Are you sure you want to delete?')) {
                $.post("{{ route('admin.delete.user') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
                        .done(function (response) {
                            if (response == 'ok') {
                                var table = $('#adminuser__table').DataTable();
                                table.row('adminDtRow' + id).remove().draw(false);
                            } else {
                                alert('Request Failed!');
                            }
                        });
            }
        }
    </script>

@endpush