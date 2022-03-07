@extends('backend.layouts.app_layout')

@section('content')
    <!-- Laravel package configured in config/app.php -->
    @include('flash::message')

    <div class="row">
        <div class="col-md-12"> 
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption"> <i class="icon-info font-dark"></i> <span class="caption-subject font-dark sbold uppercase">List</span> </div>
                    <div class="actions"> <a href="{{ route('admin.add.news') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Add News</a> </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <form method="post" role="form" id="news-search-form">
                            <table class="table table-striped table-bordered table-hover"  id="news__table">
                                <thead>
                                    <tr role="row" class="filter">
                                        <td></td>
                                        <td><input type="text" class="form-control" name="title" id="title" autocomplete="off" placeholder="Title"></td>                      
                                        <td></td>
                                    </tr>
                                    <tr role="row" class="heading">                                            
                                        <th>Media</th>
                                        <th>Title</th>
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
            var oTable = $('#news__table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: false,
                ajax: {
                    url: '{!! route('admin.list.news') !!}',
                    data: function (d) {
                        d.title = $('input[name=title]').val();
                    }
                }, columns: [
                    {data: 'media', name: 'media', orderable: false, searchable: false},
                    {data: 'title', name: 'title'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
            $('#news-search-form').on('submit', function (e) {
                
                oTable.draw();
                e.preventDefault();
            });
            
            $('#title').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
            });
        });

        function deleteRecord(id) {
            if (confirm('Are you sure you want to delete?')) {
                $.post("{{ route('admin.delete.news') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
                        .done(function (response) {
                            if (response == 'ok') {
                                var table = $('#news__table').DataTable();
                                table.row('newsDtRow' + id).remove().draw(false);
                            } else {
                                alert('Request Failed!');
                            }
                        });
            }
        }
    </script>

@endpush