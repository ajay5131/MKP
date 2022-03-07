@extends('backend.layouts.app_layout')

@section('content')
    <!-- Laravel package configured in config/app.php -->
    @include('flash::message')

    <div class="row">
        <div class="col-md-12"> 
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption"> <i class="icon-info font-dark"></i> <span class="caption-subject font-dark sbold uppercase">List</span> </div>
                    <div class="actions"> <a href="{{ route('admin.add.team') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Add Team</a> </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <form method="post" role="form" id="team-search-form">
                            <table class="table table-striped table-bordered table-hover"  id="team__table">
                                <thead>
                                    <tr role="row" class="filter">
                                        <td></td>
                                        <td>{!! Form::select('team_type', ['' => 'Select Team Type']+$team_type, null, array('class'=>'form-control', 'id'=>'team_type')) !!}</td>
                                        <td><input type="text" class="form-control" name="full_name" id="full_name" autocomplete="off" placeholder="Full Name"></td>                      
                                        <td><input type="text" class="form-control" name="designation" id="designation" autocomplete="off" placeholder="Designation"></td>                      
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr role="row" class="heading">                                            
                                        <th>Media</th>
                                        <th>Team Type</th>
                                        <th>Full Name</th>
                                        <th>Designation</th>
                                        <th>Sort Order</th>
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
            var oTable = $('#team__table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: false,
                ajax: {
                    url: '{!! route('admin.list.team') !!}',
                    data: function (d) {
                        d.full_name = $('input[name=full_name]').val();
                        d.designation = $('input[name=designation]').val();
                        d.team_type = $('#team_type').val();
                    }
                }, columns: [
                    {data: 'media', name: 'media', orderable: false, searchable: false},
                    {data: 'team_type', name: 'team_type', orderable: false, searchable: false},
                    {data: 'full_name', name: 'full_name'},
                    {data: 'designation', name: 'designation'},
                    {data: 'sort_order', name: 'sort_order'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
            $('#team-search-form').on('submit', function (e) {
                
                oTable.draw();
                e.preventDefault();
            });
            
            $('#full_name').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#designation').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#team_type').on('change', function (e) {
                oTable.draw();
                e.preventDefault();
            });
        });

        function deleteRecord(id) {
            if (confirm('Are you sure you want to delete?')) {
                $.post("{{ route('admin.delete.team') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
                        .done(function (response) {
                            if (response == 'ok') {
                                var table = $('#team__table').DataTable();
                                table.row('teamDtRow' + id).remove().draw(false);
                            } else {
                                alert('Request Failed!');
                            }
                        });
            }
        }
    </script>

@endpush