@extends('backend.layouts.app_layout')

@section('content')
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
                        <form method="post" role="form" id="page-search-form">
                            <table class="table table-striped table-bordered table-hover"  id="page__table">
                                <thead>
                                    <tr role="row" class="filter">
                                        <td><input type="text" class="form-control" name="title" id="title" autocomplete="off" placeholder="Page"></td>                      
                                        <td><input type="text" class="form-control" name="sub_title" id="sub_title" autocomplete="off" placeholder="Title"></td>                      
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr role="row" class="heading">                                            
                                        <th>Page</th>
                                        <th>Title</th>
                                        <th>Description</th>
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
            var oTable = $('#page__table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: false,
                ajax: {
                    url: '{!! route('admin.list.pagecontent') !!}',
                    data: function (d) {
                        d.title = $('input[name=title]').val();
                        d.sub_title = $('input[name=sub_title]').val();
                    }
                }, columns: [
                    {data: 'title', name: 'title'},
                    {data: 'sub_title', name: 'sub_title'},
                    {data: 'description', name: 'description'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
            $('#page-search-form').on('submit', function (e) {
                
                oTable.draw();
                e.preventDefault();
            });
            
            $('#title').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#sub_title').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
            });
            
        });
    </script>

@endpush