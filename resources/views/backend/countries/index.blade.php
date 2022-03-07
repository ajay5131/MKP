@extends('backend.layouts.app_layout')

@section('content')
    <!-- Laravel package configured in config/app.php -->
    @include('flash::message')

    <div class="row">
        <div class="col-md-12"> 
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption"> <i class="icon-info font-dark"></i> <span class="caption-subject font-dark sbold uppercase">List</span> </div>
                    <div class="actions"> <a href="{{ route('admin.add.country') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Add New Country</a> </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <form method="post" role="form" id="country-search-form">
                            <table class="table table-striped table-bordered table-hover"  id="country__table">
                                <thead>
                                    <tr role="row" class="filter"> 
                                        <td><input type="text" class="form-control" name="country" id="country" autocomplete="off" placeholder="Country"></td>                      
                                        <td></td>
                                    </tr>
                                    <tr role="row" class="heading">                                            
                                        <th>Country</th>
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
            var oTable = $('#country__table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: false,
                ajax: {
                    url: '{!! route('admin.list.country') !!}',
                    data: function (d) {
                        d.country = $('input[name=country]').val();
                    }
                }, columns: [
                    {data: 'country', name: 'country'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
            $('#country-search-form').on('submit', function (e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#country').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
            });
        });

        function deleteCountry(id) {
            if (confirm('Are you sure you want to delete?')) {
                $.post("{{ route('admin.delete.country') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
                        .done(function (response) {
                            if (response == 'ok') {
                                var table = $('#country__table').DataTable();
                                table.row('countryDtRow' + id).remove().draw(false);
                            } else {
                                alert('Request Failed!');
                            }
                        });
            }
        }
    </script>

@endpush