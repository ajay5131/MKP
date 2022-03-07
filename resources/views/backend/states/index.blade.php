@extends('backend.layouts.app_layout')

@section('content')
    <!-- Laravel package configured in config/app.php -->
    @include('flash::message')

    <div class="row">
        <div class="col-md-12"> 
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption"> <i class="icon-info font-dark"></i> <span class="caption-subject font-dark sbold uppercase">List</span> </div>
                    <div class="actions"> <a href="{{ route('admin.add.state') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Add New State</a> </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <form method="post" role="form" id="state-search-form">
                            <table class="table table-striped table-bordered table-hover"  id="state__table">
                                <thead>
                                    <tr role="row" class="filter">
                                        <td>
                                            {!! Form::select('country_id', ['' => 'Select Country']+$countries, null, array('id'=>'country_id', 'class'=>'form-control select2')) !!} 
                                        </td> 
                                        <td><input type="text" class="form-control" name="state" id="state" autocomplete="off" placeholder="State"></td>                      
                                        <td></td>
                                    </tr>
                                    <tr role="row" class="heading">                                            
                                        <th>Country</th>
                                        <th>State</th>
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
            var oTable = $('#state__table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: false,
                ajax: {
                    url: '{!! route('admin.list.state') !!}',
                    data: function (d) {
                        d.state = $('input[name=state]').val();
                        d.country_id = $('#country_id').val();
                    }
                }, columns: [
                    {data: 'country', name: 'country'},
                    {data: 'state', name: 'state'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
            $('#state-search-form').on('submit', function (e) {
                
                oTable.draw();
                e.preventDefault();
            });
            $('#country_id').on('change', function (e) {
                oTable.draw();
                e.preventDefault();
            });

            $('#state').on('keyup', function (e) {
                console.log(e);
                oTable.draw();
                e.preventDefault();
            });
        });

        function deleteRecord(id) {
            if (confirm('Are you sure you want to delete?')) {
                $.post("{{ route('admin.delete.state') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
                        .done(function (response) {
                            if (response == 'ok') {
                                var table = $('#state__table').DataTable();
                                table.row('stateDtRow' + id).remove().draw(false);
                            } else {
                                alert('Request Failed!');
                            }
                        });
            }
        }
    </script>

@endpush