@extends('backend.layouts.app_layout')

@section('content')
    <!-- Laravel package configured in config/app.php -->
    @include('flash::message')

    <div class="row">
        <div class="col-md-12"> 
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption"> <i class="icon-info font-dark"></i> <span class="caption-subject font-dark sbold uppercase">List</span> </div>
                    <div class="actions"> <a href="{{ route('admin.add.language') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Add Language</a> </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <form method="post" role="form" id="table-search-form">
                            <table class="table table-striped table-bordered table-hover"  id="table__id">
                                <thead>
                                    <tr role="row" class="filter"> 
                                        <td></td>
                                        <td><input type="text" class="form-control" name="language" id="language" autocomplete="off" placeholder="Language"></td>                      
                                        <td></td>
                                    </tr>
                                    <tr role="row" class="heading">                                            
                                        <th>Code</th>
                                        <th>Language</th>
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
            var oTable = $('#table__id').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: false,
                ajax: {
                    url: '{!! route('admin.list.language') !!}',
                    data: function (d) {
                        d.language = $('input[name=language]').val();
                    }
                }, columns: [
                    {data: 'code', name: 'code'},
                    {data: 'language', name: 'language'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
            $('#table-search-form').on('submit', function (e) {
                
                oTable.draw();
                e.preventDefault();
            });
            $('#language').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
                listStates(0);
            });
            
        });

        function changeStatus(id, status) {
            
            $.post("{{ route('admin.language.status') }}", {id: id, status: status, _method: 'POST', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        if (response == 'ok') {
                            var table = $('#table__id').DataTable();
                            table.draw();
                        } else {
                            alert('Request Failed!');
                        }
                    });
        
        }

        
    </script>

@endpush
